<?php
namespace backend\models;
use Yii;
class ActionLog extends \yii\db\ActiveRecord {
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%action_log}}';
    }
}
