<?php

namespace app\models;

use Codeception\Module\Yii1;
use Yii;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id_users;
    public $login;
    public $password_hash;
    public $authKey;
    public $accessToken;
    public $group_type;

    private static $users = [];

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
    	$user=new static(self::getUserArrayById($id));
    	Yii::info($id);
        return $user ? $user : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::getUsersArrayFromDb() as $user) {
            if (strcasecmp($user['login'], $username) === 0) {
            	Yii::info($user);
                return new static($user);
            }
        }

        return null;
    }

    public static function getUsersArrayFromDb(){
    	return Users::find()->select('id_users, login, password_hash, group_type')->asArray(1)->all();
    }

    public static function getUserArrayById($id){
	    foreach (self::getUsersArrayFromDb() as $user) {
		    if (strcasecmp($user['id_users'], $id) === 0) {
			    return new static($user);
		    }
	    }

	    return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id_users;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
    }
}
