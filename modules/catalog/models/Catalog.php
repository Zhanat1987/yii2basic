<?php

namespace app\modules\catalog\models;

use Yii;
use app\modules\organization\models\Organization;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "catalog".
 *
 * @property integer $id
 * @property string $name
 * @property integer $organization_id
 * @property integer $type
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 */
class Catalog extends ActiveRecord
{

    use \app\traits\CachedKeyValueData;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['organization_id', 'type', 'created_at', 'updated_at', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('catalog', 'ID'),
            'name' => Yii::t('catalog', 'Название'),
            'organization_id' => Yii::t('catalog', 'Организация'),
            'type' => Yii::t('catalog', 'Тип'),
            'created_at' => Yii::t('catalog', 'Дата создания'),
            'updated_at' => Yii::t('catalog', 'Дата редактирования'),
            'status' => Yii::t('catalog', 'Статус'),
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

    public function getOrganizations()
    {
        return $this->hasMany(Organization::className(), ['organization_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->status == 1) {
                $cache = Yii::$app->cache;
                $cache->delete(self::tableName() . 'getAllForLists');
                $cache->delete(self::tableName() . 'getAllForLists' . $this->type);
                if ($this->organization_id) {
                    $cache->delete(self::tableName() . 'getAllForLists' .
                        $this->type . $this->organization_id);
                }
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
                $cache->delete(self::tableName() . 'getAllForLists' . $this->type);
                if ($this->organization_id) {
                    $cache->delete(self::tableName() . 'getAllForLists' .
                        $this->type . $this->organization_id);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public static function getAllForLists($type = null, $organization = null)
    {
        $where['status'] = 1;
        $key = 'getAllForLists';
        if ($type !== null) {
            $where['type'] = $type;
            $key .= $type;
            if ($organization !== null) {
                $where['organization_id'] = $organization;
                $key .= $organization;
            }
        }
        return self::getCachedKeyValueData(
            self::tableName(),
            ['id', 'name'],
            $where,
            $key
        );
    }

    public function getCommon($k = null)
    {
        $common = [
            1 => 'Область',
            2 => 'Адм. ед. области',
            3 => 'Город',
            4 => 'Улица',
            5 => 'Дефект',
            6 => 'Результат лечения',
            7 => 'Документ',
            8 => 'Кем выдан',
        ];
        return $k == null ? $common : $common[$k];
    }

    public function getOrganization($k = null)
    {
        $organization = [
            9  => 'Причина уничтожения',
            10 => 'Гражданство',
            11 => 'Поликлиника прикрепления',
            12 => 'Показания',
            13 => 'Цель',
            14 => 'Способ утилизации',
            15 => 'Отделение',
        ];
        return $k == null ? $organization : $organization[$k];
    }

    public static function getCommonData($k, $valueTitle)
    {
        $common = [
            'region_id' => [1, 'Область'],
            'region_area_id' => [2, 'Адм. ед. области'],
            'city_id' => [3, 'Город'],
            'street_id' => [4, 'Улица'],
            'defect_id' => [5,  'Дефект'],
            'treatment_outcome_id' => [6, 'Результат лечения'],
            'document_types_id' => [7, 'Документ'],
            'document_issued_id' => [8, 'Кем выдан'],
        ];
        return $common[$k][$valueTitle];
    }

    public static function getOrganizationData($k)
    {
        $organization = [
            'causes_destruction_id' => 9,
            'citizenship_id' => 10,
            'clinics_attachment_id' => 11,
            'statement_id' => 12,
            'request_target_id' => 13,
            'methods_utilization_id' => 14,
            'department_id' => 15,
        ];
        return $organization[$k];
    }

}