<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id_users
 * @property string $login
 * @property string $password_hash
 * @property int $id_permissions
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password_hash', 'id_permissions'], 'required'],
            [['id_permissions'], 'integer'],
            [['login'], 'string', 'max' => 150],
            [['password_hash'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_users' => 'Id Users',
            'login' => 'Login',
            'password_hash' => 'Password Hash',
            'id_permissions' => 'Id Permissions',
        ];
    }

    public static function findUser($login, $password){
		$user=self::find()->where(['login'=>$login])->limit(1)->one();
	    $hash=Yii::$app->getSecurity()->generatePasswordHash($password);
	    if(Yii::$app->getSecurity()->validatePassword($password, $hash)){
	    	return $user;
	    }else{
	    	return false;
	    }
    }

}
