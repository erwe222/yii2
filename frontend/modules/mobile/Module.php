<?php

namespace frontend\modules\mobile;

/**
 * mobile module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\mobile\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        //设置默认的控制器
        $this->defaultRoute = 'index';
        
        // custom initialization code goes here
    }
}
