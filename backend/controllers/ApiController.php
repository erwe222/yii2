<?php
namespace backend\controllers;
use Yii;
use yii\helpers\Json;
use backend\models\ActionLog;
class ApiController extends CController {
    
    /**
     * 获取前台table请求信息
     */
    public function getTableParams(){
        $request = Yii::$app->request;
        $array = [];
        $page = $request->post('page',0);
        $array['limit'] = $request->post('limit',20);
        $array['offset'] = ($page - 1) * $array['limit'];
        $array['orderBy'] = $request->post('orderBy','id');
        $array['sort'] = $request->post('sort','desc');
        return $array;
    }
    
    /**
     * 获取后台操作日志列表
     */
    public function actionGetManageLogList(){
        $params = $this->getTableParams();
        $query = ActionLog::find();
        $conunt = (int)$query->count();
        $route_array = $query->offset($params['offset'])->limit($params['limit'])->orderBy("{$params['orderBy']} {$params['sort']}")->asArray()->all();
        $filter_totel = count($route_array);
        $array = array('code'=>0,'msg'=>'','count'=>$conunt,'data'=>$route_array);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;   // json 返回
        return $array;
    }
    
    /**
     * 更新微信菜单
     */
    public function actionUpdateWechatMenu(){
        
        dump($_REQUEST['username']);
        return 'asdfa';
    }
}