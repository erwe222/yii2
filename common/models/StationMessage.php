<?php

namespace common\models;

/**
 * Description of StationMessage
 *
 * @author dell
 */
class StationMessage extends \yii\db\ActiveRecord{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%station_message}}';
    }
}
