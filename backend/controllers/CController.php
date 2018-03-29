<?php 
namespace backend\controllers;

use Yii;
use yii\web\UnauthorizedHttpException;
use yii\web\Controller;
use backend\models\Menu;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
* 
*/
class CController extends Controller {

    // 访问控制器前进行权限验证
    public function beforeAction($action){
        
    	header('Content-Type:text/html;charset=utf-8');

        // // 主控制器验证
        if ( ! parent::beforeAction($action)) {return false;}

        if(Yii::$app->user->id == null){
            return $this->redirect('login/login');
        }
        
        //判断是否是ajax访问
        if (!Yii::$app->request->isAjax){
            $menu_model = new Menu();
            $cache_menu = $menu_model->getNavigation();
            if(count($cache_menu) == 0){
                $cache_menu = $menu_model->setNavigation();
            }

            $this->setViewParams('menus',$cache_menu);
            $this->setViewParams('url','/'.$action->controller->id . '/' . $action->id);
            $auth = Yii::$app->authManager;
            $role_names = $auth->getRolesByUser(YII::$app->user->id);
            $role_name = '';
            if(count($role_names) > 0){
                foreach ($role_names as $key=>$_v){$role_name .= ','.$key;}
                $role_name = ltrim($role_name,',');
            }
            /*用户信息*/
            $this->setViewParams('admin',array(
                'username'=>Yii::$app->getUser()->identity->attributes['username'],
                'email'=>Yii::$app->getUser()->identity->attributes['email'],
                'admin_role'=>$role_name
            ));
            
        }

        // 验证权限
        if( ! Yii::$app->user->can('/'.$action->controller->id . '/' . $action->id) && Yii::$app->getErrorHandler()->exception === null) {
            // 没有权限AJAX返回
            if (Yii::$app->request->isAjax){
                exit(Json::encode(['errCode' => 216, 'errMsg' => '对不起，您现在还没获得该操作的权限!', 'data' => []]));
            }else{
            	// ForbiddenHttpException表示具有状态代码403的“禁止”HTTP异常。
            	throw new \yii\web\ForbiddenHttpException("对不起，您现在还没获得该操作的权限!");
                // UnauthorizedHttpException表示具有状态码401的“未授权”HTTP异常
                //throw new UnauthorizedHttpException('对不起，您现在还没获得该操作的权限!');
            }
        }
        return true;
    }

    /**
     * 获取用户的授权目录
     * @return object
     */
    public function getAuthorityMenu(){
        return $arrAuth = Yii::$app->getAuthManager()->getPermissionsByUser(Yii::$app->user->id);
    }

    /**
     * 设置视图层信息
     * @param string $key 
     * @param mixed $value
     */
    public function setViewParams($key,$value) {
        Yii::$app->view->params[$key] = $value;
    }
    
    /*
     * 获取前台表格查询的条件
     */
    public function query(){
        $request = Yii::$app->request;
        $params  = $request->post('params');                    // 接收查询参数
        $sort    = $request->post('sSortDir_0', 'asc');         // 排序方式
        $default_sort = 'id';                                   // 默认排序方式
        $tmp_params = [];
        if(count($params) > 0){
            foreach ($params as $key=>$val){
                $tmp = trim($val);
                if( $key == 'orderby' || empty($tmp)){continue;}
                $tmp_params[$key] = addslashes(trim($val));
            }
        }
        
        // 接收参数
        $sFile   = isset($params['orderby']) && ! empty($params['orderby']) ? $params['orderby'] : $default_sort; // 排序字段
        $aSearch = [
            'orderBy' => $sFile,
            'sort'=>$sort,
            'where'   => $tmp_params,                                // 查询条件
            'offset'  => (int)$request->post('iDisplayStart',  0),   // 查询开始位置
            'limit'   => (int)$request->post('iDisplayLength', 10),  // 查询数据条数
            'echo'    => (int)$request->post('sEcho',          1),   // 查询次数
        ];
        unset($params);
        return $aSearch;
    }

}