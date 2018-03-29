<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models;

/**
 * Description of SmsLog
 *
 * @author dell
 */
class SmsLog extends \yii\db\ActiveRecord{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sms_log}}';
    }
}
