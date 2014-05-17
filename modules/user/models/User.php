<?php

namespace app\modules\user\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use app\modules\rbac\models\AuthAssignment;
use app\modules\organization\models\Organization;
use app\myhelpers\Debugger;
use app\myhelpers\Current;
use app\modules\rbac\models\AuthItem;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property string $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property string $surname
 * @property string $name
 * @property string $patronymic
 * @property integer $organization_id
 * @property string $department
 * @property string $post
 * @property string $columns
 */
class User extends ActiveRecord implements IdentityInterface
{

    use \app\traits\CachedKeyValueData;

    public $password;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * Creates a new user
     *
     * @param  array $attributes the attributes given by field => value
     * @return static|null the newly created model, or null on failure
     */
    public static function create($attributes)
    {
        /** @var User $user */
        $user = new static();
        $user->setAttributes($attributes);
        $user->setPassword($attributes['password']);
        $user->generateAuthKey();
        if ($user->save()) {
            return $user;
        } else {
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param  string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => 1]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => 1,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Security::validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => 1],
            ['status', 'in', 'range' => array_keys($this->getStatuses())],
            [['status'], 'integer'],

            ['role', 'required'],
            ['role', 'in', 'range' => array_keys(AuthItem::getRoles())],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique'],

            ['password', 'filter', 'filter' => 'trim'],
            ['password', 'required', 'on' => 'create'],
            ['password', 'string', 'min' => 6],

            [['surname', 'name', 'patronymic'], 'filter', 'filter' => 'trim'],
            [['surname', 'name'], 'required'],
            [['surname', 'name', 'patronymic'], 'string', 'min' => 2, 'max' => 255],

            [['organization_id'], 'integer'],

            [['department', 'post'], 'filter', 'filter' => 'trim'],
            [['department', 'post'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя пользователя',
            'email' => 'E-mail пользователя',
            'password' => 'Пароль',
            'role' => 'роль',
            'status' => 'Статус',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
            'organization_id' => 'Организация',
            'department' => 'Отдел',
            'post' => 'Должность',
            'columns' => "Колонки пользователя в grid'ах",
            'auth_key' => 'уникальный ключ авторизации каждого пользователя',
            'password_hash' => 'хэш пароля',
            'password_reset_token' => 'token восстановления пароля',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * https://github.com/yiisoft/yii2/blob/master/docs/guide/
     * db-active-record.md#working-with-relational-data
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = Security::generateRandomKey();
            }
            if ($this->password) {
                $this->password_hash = Security::generatePasswordHash($this->password);
            }
            if ($this->status == 1) {
                Yii::$app->cache->delete(self::tableName() . 'getAllForLists');
            }
            return true;
        } else {
            return false;
        }
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            Yii::$app->authManager->revokeAll($this->id);
            if ($this->status == 1) {
                Yii::$app->cache->delete(self::tableName() . 'getAllForLists');
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert)
    {
        try {
            $auth = Yii::$app->authManager;
            $auth->revokeAll($this->id);
            $auth->assign($auth->getRole($this->role), $this->id);
        } catch (Exception $e) {
            Yii::warning($e->getCode() . ' - ' . $e->getMessage(), 'auth assign');
        }
        return parent::afterSave($insert);
    }

    public function getStatuses($status = null)
    {
        /**
         * сливает массивы и сохраняет ключи
         */
        $statuses = array_replace(Current::getStatuses(), [-1 => 'Забаненный']);
        return $status !== null ? $statuses[$status] : $statuses;
    }

    public static function getAllForLists()
    {
        return self::getCachedKeyValueData(
            self::tableName(),
            ['id', 'username'],
            ['status' => 1],
            'getAllForLists'
        );
    }

}