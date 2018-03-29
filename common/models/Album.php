<?php
namespace common\models;
use Yii;

class Album extends \yii\db\ActiveRecord {
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%album}}';
    }
}
