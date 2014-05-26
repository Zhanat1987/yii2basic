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
            [['name'], 'string', 'max' => 255],
            [['status'], 'default', 'value' => 1],
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
            if ($organization !== null && Yii::$app->session->get('role') != 'супер-администратор') {
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
            1 => Yii::t('catalog', 'Область'),
            2 => Yii::t('catalog', 'Адм. ед. области'),
            3 => Yii::t('catalog', 'Город'),
            4 => Yii::t('catalog', 'Улица'),
            5 => Yii::t('catalog', 'Дефект'),
            6 => Yii::t('catalog', 'Результат лечения'),
            7 => Yii::t('catalog', 'Документ'),
            8 => Yii::t('catalog', 'Кем выдан'),
            9 => Yii::t('catalog', 'Гражданство'),
        ];
        return $k == null ? $common : $common[$k];
    }

    public function getOrganization($k = null)
    {
        $organization = [
            10 => Yii::t('catalog', 'Отделение'),
            11 => Yii::t('catalog', 'Поликлиника прикрепления'),
            12 => Yii::t('catalog', 'Показания'),
            13 => Yii::t('catalog', 'Цель'),
            14 => Yii::t('catalog', 'Способ утилизации'),
        ];
        return $k == null ? $organization : $organization[$k];
    }

    public static function getCommonData($k, $valueTitle)
    {
        $common = [
            'region_id' => [
                1,
                Yii::t('catalog', 'Область'),
                Yii::t('catalog', 'Добавление области')
            ],
            'region_area_id' => [
                2,
                Yii::t('catalog', 'Адм. ед. области'),
                Yii::t('catalog', 'Добавление адм. ед. области')
            ],
            'city_id' => [
                3,
                Yii::t('catalog', 'Город'),
                Yii::t('catalog', 'Добавление города')
            ],
            'street_id' => [
                4,
                Yii::t('catalog', 'Улица'),
                Yii::t('catalog', 'Добавление улицы')
            ],
            'defect_id' => [5,  Yii::t('catalog', 'Дефект')],
            'treatment_outcome_id' => [6, Yii::t('catalog', 'Результат лечения')],
            'document_types_id' => [7, Yii::t('catalog', 'Документ')],
            'document_issued_id' => [8, Yii::t('catalog', 'Кем выдан')],
            'citizenship_id' => [9, Yii::t('catalog', 'Гражданство')],
            'target' => [
                13,
                Yii::t('catalog', 'Цель'),
                Yii::t('catalog', 'Добавление цели')
            ],
        ];
        return $common[$k][$valueTitle];
    }

    public static function getOrganizationData($k, $valueTitle)
    {
        $organization = [
            'department_id' => 10,
            'clinics_attachment_id' => 11,
            'statement_id' => 12,
            'request_target_id' => [
                13,
                Yii::t('catalog', 'Цель'),
                Yii::t('catalog', 'Добавление цели')
            ],
            'methods_utilization_id' => 14,
        ];
        return $organization[$k][$valueTitle];
    }

    public function getCatalogType($k)
    {
        if (in_array($k, [1, 2, 3, 4, 5, 6, 7, 8, 9])) {
            return ['common', $this->getCatalogForm($k)];
        } else if (in_array($k, [10, 11, 12, 13, 14])) {
            return ['organization', $this->getCatalogForm($k)];
        } else {
            return false;
        }
    }

    public function getCatalogForm($k)
    {
        $catalog = [
            1 => Yii::t('catalog', 'область'),
            2 => Yii::t('catalog', 'одм. ед. области'),
            3 => Yii::t('catalog', 'город'),
            4 => Yii::t('catalog', 'улицу'),
            5 => Yii::t('catalog', 'дефект'),
            6 => Yii::t('catalog', 'результат лечения'),
            7 => Yii::t('catalog', 'документ'),
            8 => Yii::t('catalog', 'кем выдано'),
            9 => Yii::t('catalog', 'гражданство'),
            10 => Yii::t('catalog', 'отделение'),
            11 => Yii::t('catalog', 'поликлинику прикрепления'),
            12 => Yii::t('catalog', 'показания'),
            13 => Yii::t('catalog', 'цель'),
            14 => Yii::t('catalog', 'способ утилизации'),
        ];
        return $catalog[$k];
    }

}