<?php
namespace backend\controllers;

use Yii;
use backend\models\Menu;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use backend\components\Helper;

class MenuController extends CController {

    public function actionIndex(){
        $menu_model = new Menu();
        $menu_array = $menu_model::find()->where(['pid' =>0])->select('id,menu_name')->asArray()->all();
        array_unshift($menu_array, array('id'=>0,'menu_name'=>'顶级分栏'));
        return $this->render('index',['model'=>$menu_model,'menu_list'=>$menu_array]);
    }

    /*
     * 获取菜单列表
     */
    public function actionGetMenuList(){
        $search_params = $this->query();
        $sql = 'select *,IFNULL((select menu_name FROM yd_menu B where B.id = A.pid),"顶级分栏") as parent_name from yd_menu A where 1=1 ';
        if(isset($search_params['where']['status']) && $search_params['where']['status'] != 'all'){
            $sql .= 'AND A.status ='.$search_params['where']['status'];
        }
        if(isset($search_params['where']['menu_name']) && !empty($search_params['where']['menu_name'])){
            $sql .= "AND A.menu_name like '%{$search_params['where']['menu_name']}%'";
        }
        $conunt = Menu::findBySql($sql)->count();
        $sql .= " order by {$search_params['orderBy']} {$search_params['sort']} limit {$search_params['offset']},{$search_params['limit']}";
        $query2 = Menu::findBySql($sql);
        $route_array = $query2->asArray()->all();
        $filter_totel = count($route_array);

        #服务端返回的JSON数据如下所示。其中draw是请求中的draw参数，data是表格中的数据。recordsFiltered是过滤后的数据总数，recordsTotal是原始数据总数。
        $array = array(
            'iTotalDisplayRecords'=>$conunt,
            'iTotalRecords'=>$filter_totel,
            'sEcho'=>$search_params['echo'],
            'data'=>$route_array,
        );
        return Json::encode($array);
    }
    
    /**
     * 添加菜单栏
     */
    public function actionCreate(){
        $arrJson = ['errCode' => 202,'errMsg'  => '数据添加失败，请稍候重试。。。','data'    => []];
        $model = new Menu;
        $data = Yii::$app->request->post();
        if ($data) {
            $data['edit_user_id'] = Yii::$app->user->id;
            $result = $model->load(['params' => $data], 'params');
            if ($result && $model->save()) {
                $arrJson['errCode'] = 201;
                $arrJson['errMsg'] = '数据添加成功。。。';
            }
        }
        return json_encode($arrJson);
    }

    /**
     * 修改菜单栏
     */
    public function actionUpdate(){
        $arrJson = ['errCode' => 202,'errMsg'  => '数据更新失败，请稍候重试。。。','data'    => []];
        if(Yii::$app->request->post()){
            $id = Yii::$app->request->post('id');  
            $model = $this->findModel((int)$id);
            if ($model->load(['params' => Yii::$app->request->post()], 'params') && $model->save()) {
                $arrJson['errCode'] = 201;
                $arrJson['errMsg'] = '数据更新成功。。。';
            } 
        }
        return json_encode($arrJson);
    }

    /**
     * 删除菜单栏
     */
    public function actionDelete(){
        $arrJson = ['errCode' => 202,'errMsg'  => '数据删除失败，请稍候重试。。。','data'    => []];
        $id = Yii::$app->request->post('id',0); 
        if($id !== 0){
            $result = $this->findModel($id)->delete();
            if($result){
                $arrJson['errCode'] = 201;
                $arrJson['errMsg'] = '数据删除成功。。。';
            }
        }
        return json_encode($arrJson);
    }

    /**
     * 根据主键值查找菜单模型。
     */
    protected function findModel($id){
        if (($model = Menu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
