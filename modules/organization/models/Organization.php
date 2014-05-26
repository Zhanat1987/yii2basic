<?php

namespace app\modules\organization\models;

use Yii;
use app\modules\catalog\models\Catalog;
use app\modules\user\models\User;
use yii\db\ActiveRecord;
use app\modules\catalog\models\Personal;
use app\modules\rbac\models\AuthAssignment;
use app\modules\rbac\models\AuthItem;
use yii\db\Exception;

/**
 * This is the model class for table "organization".
 *
 * @property integer $id
 * @property string $name
 * @property string $short_name
 * @property string $role
 * @property integer $region_id
 * @property integer $region_area_id
 * @property integer $city_id
 * @property integer $street_id
 * @property string $home_number
 * @property string $phone
 * @property string $email
 * @property string $url
 * @property string $chief_phone
 * @property string $chief_email
 * @property integer $infodonor_id
 * @property integer $bin
 * @property string $curl
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 */
class Organization extends ActiveRecord
{

    use \app\traits\CachedKeyValueData;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'short_name'], 'required'],
            [
                [
                    'region_id',
                    'region_area_id',
                    'city_id',
                    'street_id',
                    'infodonor_id',
                    'bin',
                    'created_at',
                    'updated_at',
                    'status'
                ],
                'integer'
            ],
            [
                [
                    'name',
                    'short_name',
                    'home_number',
                    'phone',
                    'email',
                    'url',
                    'chief_phone',
                    'chief_email',
                    'curl'
                ],
                'string',
                'max' => 255
            ],
            [['email', 'chief_email'], 'email'],
            [['url', 'curl'], 'url'],
            [
                [
                    'name',
                    'short_name',
                    'home_number',
                    'phone',
                    'email',
                    'url',
                    'chief_phone',
                    'chief_email',
                    'curl'
                ],
                'filter',
                'filter' => 'trim'
            ],

            ['role', 'required'],
            ['role', 'in', 'range' => array_keys(AuthItem::getRoles())],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('organization', 'ID'),
            'name' => Yii::t('organization', 'Наименование организации'),
            'short_name' => Yii::t('organization', 'Сокращенное наименование организации'),
            'role' => Yii::t('organization', 'Роль'),
            'region_id' => Yii::t('organization', 'Область'),
            'region_area_id' => Yii::t('organization', 'Административная единица области'),
            'city_id' => Yii::t('organization', 'Город'),
            'street_id' => Yii::t('organization', 'Улица'),
            'home_number' => Yii::t('organization', '№ дома'),
            'phone' => Yii::t('organization', 'Телефон приемной организации'),
            'email' => Yii::t('organization', 'Е-mail приемной органищации'),
            'url' => Yii::t('organization', 'Сайт организации'),
            'chief_phone' => Yii::t('organization', 'Телефон директора'),
            'chief_email' => Yii::t('organization', 'Е-mail директора'),
            'infodonor_id' => Yii::t('organization', 'Код организации в Info Donor'),
            'bin' => Yii::t('organization', 'БИН'),
            'curl' => Yii::t('organization', 'URL для запроса о КК/ПК'),
            'created_at' => Yii::t('organization', 'Дата создания'),
            'updated_at' => Yii::t('organization', 'Дата редактирования'),
            'status' => Yii::t('organization', 'Статус'),
        ];
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

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['organization_id' => 'id']);
    }

    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'organization_id']);
    }

    public function getPersonals()
    {
        return $this->hasMany(Personal::className(), ['organization_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['organization_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->status == 1) {
                Yii::$app->cache->delete(self::tableName() . 'getAllForLists');
                Yii::$app->cache->delete(self::tableName() . 'getAllForListsByRole' . $this->role);
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
                Yii::$app->cache->delete(self::tableName() . 'getAllForListsByRole' . $this->role);
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

    public static function getAllForLists()
    {
        return self::getCachedKeyValueData(
            self::tableName(),
            ['id', 'name'],
            ['status' => 1],
            'getAllForLists'
        );
    }

    public static function getAllForListsByRole($role)
    {
        return self::getCachedKeyValueData(
            self::tableName(),
            ['id', 'name'],
            ['status' => 1, 'role' => $role],
            'getAllForListsByRole' . $role
        );
    }

}