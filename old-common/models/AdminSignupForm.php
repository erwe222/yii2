<?php
namespace common\models;

use Yii;
use yii\base\Model;
use common\models\Admin;

/**
 * Signup form
 */
class AdminSignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $user_role;
    public $status;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Admin', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Admin', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['status','safe']
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return false;
        }
        $user = new Admin();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->status = $this->status;
        $user->role_name = $this->user_role;
        return $user->save();
    }
    
    public function findRole($name){
        $manager = Yii::$app->authManager;
        $role = $manager->getRole($name);
        if($role){
            return $role['name'];
        }else{
            return null;
        }
    }
}
