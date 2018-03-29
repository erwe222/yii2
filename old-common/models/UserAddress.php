<?php
namespace common\models;
use Yii;

class UserAddress extends \yii\db\ActiveRecord {
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_address}}';
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id'            =>   '用户ID',
            'consignee'          =>   '收货人',
            'mobile'             =>   '手机号',
            'city'               =>   '城市地址',
            'address'            =>   '详细地址',
            'created_time'       =>   '创建时间',
            'updated_time'       =>   '修改时间'
        ];
    }
    
}
