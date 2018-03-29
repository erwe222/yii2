<?php 

use yii\helpers\Url;
$str =  Yii::$app->controller->id.'/'.Yii::$app->controller->action->id;
$is_login = Yii::$app->view->params['is_login'];
?>
<footer class="aui-footer-default aui-footer-fixed">
        <a href="<?= Url::toRoute('index/index')?>" class="aui-footer-item 
           <?php if(strcasecmp($str, 'index/index') == 0):?>aui-footer-active<?php endif;?>
           ">
                <span class="aui-footer-item-icon aui-icon aui-footer-icon-home"></span>
                <span class="aui-footer-item-text">首页</span>
        </a>
        <a href="<?= Url::toRoute('product/class')?>" class="aui-footer-item
        <?php if(strcasecmp($str, 'product/class') == 0):?>aui-footer-active<?php endif;?>"
        >
                <span class="aui-footer-item-icon aui-icon aui-footer-icon-class"></span>
                <span class="aui-footer-item-text">分类</span>
        </a>
        <a href="<?= Url::toRoute('product/shopp-find')?>" class="aui-footer-item
        <?php if(strcasecmp($str, 'product/shopp-find') == 0):?>aui-footer-active<?php endif;?>
        ">
                <span class="aui-footer-item-icon aui-icon aui-footer-icon-find"></span>
                <span class="aui-footer-item-text">发现</span>
        </a>
        <a href="<?= Url::toRoute('product/shopp-cart')?>" class="aui-footer-item
        <?php if(strcasecmp($str, 'product/shopp-cart') == 0):?>aui-footer-active<?php endif;?>
        ">
                <span class="aui-footer-item-icon aui-icon aui-footer-icon-car"></span>
                <span class="aui-footer-item-text">购物车</span>
        </a>
    
        <?php if($is_login):?>
        <a href="<?= Url::toRoute('user/main')?>" class="aui-footer-item
        <?php if(strcasecmp($str, 'user/main') == 0):?>aui-footer-active<?php endif;?>
        ">
                <span class="aui-footer-item-icon aui-icon aui-footer-icon-me"></span>
                <span class="aui-footer-item-text">我的</span>
        </a>
    
        <?php  else:?>
        <a href="<?= Url::toRoute('login/signin')?>" class="aui-footer-item">
                <span class="aui-footer-item-icon aui-icon aui-footer-icon-me"></span>
                <span class="aui-footer-item-text">登录</span>
        </a>
        <?php endif;?>
        
</footer>