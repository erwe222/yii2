<?php
namespace backend\controllers;

use Yii;
use backend\models\AuthItem;
use backend\models\Route;
use yii\filters\VerbFilter;
use yii\helpers\Json;

class RouteController extends CController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'create' => ['post'],
                    'assign' => ['post'],
                    'remove' => ['post'],
                    'refresh' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Route models.
     * @return mixed
     */
    public function actionIndex(){
        $aa = $this->getRoutes();
        return $this->render('index',['route_arr'=>$aa]);
    }

    /**
     * 
     */
    public function actionGetRouteList(){
        $search_params = $this->query();
        $query = AuthItem::find()->where(['type' =>2]);
        if(count($search_params['where']) > 0){
            if(isset($search_params['where']['description'])){
                $query->andWhere(['like', 'description', $search_params['where']['description']]);
            }
            if(isset($search_params['where']['name'])){
                $query->andWhere(['like', 'name', $search_params['where']['name']]);
            }
        }
        $conunt = (int)$query->count();
        $route_array = $query->offset($search_params['offset'])->limit($search_params['limit'])->asArray()->all();
        $filter_totel = count($route_array);
        
        $array = array(
            'iTotalDisplayRecords'=>$conunt,
            'iTotalRecords'=>$filter_totel,
            'sEcho'=>$search_params['echo'],
            'data'=>$route_array,
        );

        return Json::encode($array);
    }

    /**
     * 添加权限
     */
    public function actionAssign()
    {
        $arrJson = ['errCode' => 216,'errMsg'  => '权限添加失败。。。','data'    => []];
        $request = Yii::$app->request->post();
        $auth_item = new AuthItem();
        $auth_item->name = $request['name'];
        $auth_item->description = $request['description'];
        $is_true = $auth_item->createPermission();
        if($is_true){
            $arrJson = ['errCode' => 201,'errMsg'  => '数据添加成功。。。','data'    => []];
        }
        return json_encode($arrJson);
    }
    
    /**
     * 删除权限
     * @return type
     */
    public function actionRemove()
    {
        $arrJson = ['errCode' => 216,'errMsg'  => '权限删除失败。。。','data'    => []];
        $routes = Yii::$app->getRequest()->post('routes', []);
        if(count($routes) > 0){
            $auth_item = new AuthItem();
            $is_true = $auth_item->removePermissions($routes);
            if($is_true){
                $arrJson['errCode'] = 201;
                $arrJson['errMsg'] = '权限成功移除。。。';
            }
        }
        return json_encode($arrJson);
    }
    
    /**
     * 更新权限
     * @return type
     */
    public function actionUpdate(){
        $arrJson = ['errCode' => 216,'errMsg'  => '权限数据更新失败。。。','data'    => []];
        $array = Yii::$app->request->post();dump($array);
        $auth_item = new AuthItem();
        if($auth_item->load(['params' => $array], 'params')){
            $is_true = $auth_item->updatePermission($array['name']);
            if($is_true){
                $arrJson['errCode'] = 201;
                $arrJson['errMsg'] = '权限信息更新成功。。。';
            }
        }
        return json_encode($arrJson);
    }
    
    /**
     * 获取待添加权限列表
     * @return type
     */
    public function getRoutes(){
        $model = new Route();
        $array = $model->getRoutes();
        $assigned = $array['assigned'];
        $available = array();
        foreach ($array['available'] as $_v) {
            if(stripos($_v,'admin') === false && stripos($_v,'debug') === false && stripos($_v,'gii') === false && stripos($_v,'*') === false){
                $available[] = $_v;
            }
        }
        return array('assigned'=>$assigned,'available'=>$available);
    }
}
