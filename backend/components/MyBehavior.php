<?php
namespace backend\components;

use Yii;

/**
 * 控制其中获取自定的行为类
 * $myBehavior = $this->getBehavior('myBehavior2');
 * var_dump($myBehavior);
 */
class MyBehavior extends \yii\base\ActionFilter
{
    public function beforeAction ($action)
    {
        // var_dump(111);
        return true;
    }

    public function isGuest ()
    {
        return Yii::$app->user->isGuest;
    }
}