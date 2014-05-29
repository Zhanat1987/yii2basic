<?php

namespace app\modules\catalog\models;

use Yii;
use app\modules\organization\models\Organization;
use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * This is the model class for table "personal".
 *
 * @property integer $id
 * @property string $surname
 * @property string $name
 * @property string $patronimic
 * @property string $post
 * @property integer $department
 * @property integer $organization_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 */
class Personal extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['surname', 'name', 'organization_id'], 'required'],
            [['department', 'organization_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['surname', 'name', 'patronimic', 'post'], 'string', 'max' => 255],
            [
                [
                    'department',
                ],
                'default',
                'value' => null
            ],
            ['status', 'default', 'value' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('personal', 'ID'),
            'surname' => Yii::t('personal', 'Фамилия'),
            'name' => Yii::t('personal', 'Имя'),
            'patronimic' => Yii::t('personal', 'Отчество'),
            'post' => Yii::t('personal', 'Должность'),
            'department' => Yii::t('personal', 'Отделение'),
            'organization_id' => Yii::t('personal', 'Организация'),
            'created_at' => Yii::t('personal', 'Дата создания'),
            'updated_at' => Yii::t('personal', 'Дата редактирования'),
            'status' => Yii::t('personal', 'Статус'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->status == 1) {
                $cache = Yii::$app->cache;
                $cache->delete(self::tableName() . 'getAllForLists');
                $cache->delete(self::tableName() . 'getAllForLists' . $this->organization_id);
            }
            return true;
        } else {
            return false;
        }
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            if ($this->status == 1) {
                $cache = Yii::$app->cache;
                $cache->delete(self::tableName() . 'getAllForLists');
                $cache->delete(self::tableName() . 'getAllForLists' . $this->organization_id);
            }
            return true;
        } else {
            return false;
        }
    }

    public static function getAllForLists()
    {
        $key = self::tableName() . 'getAllForLists' .
            (Yii::$app->session->get('role') == 'супер-администратор' ? '' :
                Yii::$app->session->get('organizationId'));
        if (($data = unserialize(Yii::$app->cache->get($key))) === false) {
            $data = [];
            $where = ['status' => 1];
            if (Yii::$app->session->get('role') != 'супер-администратор') {
                $where['organization_id'] = Yii::$app->session->get('organizationId');
            }
            $rows = (new Query)
                ->select('id, surname, name, patronimic')
                ->from(self::tableName())
                ->where($where)
                ->all();
            if ($rows) {
                foreach ($rows as $row) {
                    $data[$row['id']] = $row['surname'] . ' ' . $row['name'] .
                        ($row['patronimic'] ? ' ' . $row['patronimic'] : '');
                }
            }
            Yii::$app->cache->set($key, serialize($data), 86400);
        }
        return $data;
    }

}