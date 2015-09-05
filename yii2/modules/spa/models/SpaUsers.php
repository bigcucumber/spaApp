<?php

namespace app\modules\spa\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "spa_users".
 *
 * @property string $id
 * @property integer $type_id
 * @property string $username
 * @property string $password
 * @property integer $salt
 * @property string $email
 * @property string $sex
 * @property integer $birthday
 * @property string $last_login_ip
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 */
class SpaUsers extends \yii\db\ActiveRecord implements IdentityInterface
{

    public $authKey = null;
    public $accessToken = null;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spa_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'last_login_ip', 'created_at'], 'required'],
            ['username', 'unique'],
            [['salt', 'birthday', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['sex', 'type_id'], 'string'],
            [['username', 'password'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 128],
            [['last_login_ip'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Type Id',
            'username' => 'Username',
            'password' => 'Password',
            'salt' => 'Salt',
            'email' => 'Email',
            'sex' => 'Sex',
            'birthday' => 'Birthday',
            'last_login_ip' => 'Last Login Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * @inheritdoc
     * @return SpaUsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SpaUsersQuery(get_called_class());
    }

    public function validatePassword($password = '')
    {
        return $this->getAttribute('password') == md5($this->getAttribute('salt') . $password);
    }

    public function extraFields()
    {
        return [
            'accessToken' => function(){
                return md5($this -> id . $this -> username);
            },
            'authKey' => function(){
                return md5($this -> id . $this -> password);
            }

        ];
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return self::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::find() -> where(['id' => $token]) -> one();
    }

}
