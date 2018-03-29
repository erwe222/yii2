<?php

namespace frontend\modules\mobile\controllers;
use frontend\modules\mobile\controllers\CController;

/**
 * Description of ProductControllers
 *
 * @author dell
 */
class ProductController extends CController {
    
    public $layout = 'main';
    
    /**
     * 购物车详情页
     */
    public function actionShoppCart(){
        return $this->render('shopp-cart');
    }
    
    /**
     * 购物车详情页
     */
    public function actionDetail() {
        return $this->render('shopp-cart');
    }
    
    /**
     * 我的订单
     */
    public function actionMyOrder(){
        return $this->render('my-order');
    }
    
    /**
     * 产品查询页面
     */
    public function actionShoppFind(){
        return $this->render('shopp-find');
    }
    
    /**
     * 产品分类页面
     */
    public function actionClass(){
        return $this->render('class');
    }
    
}
