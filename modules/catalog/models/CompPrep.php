<?php

namespace app\modules\catalog\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "comp_prep".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property string $short_name
 * @property string $alert_time
 * @property integer $infodonor_id
 * @property string $group
 * @property string $code
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 */
class CompPrep extends ActiveRecord
{

    use \app\traits\CachedKeyValueData;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comp_prep';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'name', 'short_name', 'status'], 'required'],
            [['type', 'infodonor_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['short_name'], 'string', 'max' => 100],
            [['alert_time'], 'string', 'max' => 50],
            [['group', 'code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('comp_prep', 'Ключевое поле компонента / препарата'),
            'type' => Yii::t('comp_prep', 'Тип компонентов / препаратов (1 - Компонент, 2 - Препарат)'),
            'name' => Yii::t('comp_prep', 'Наименование компонента / препарата'),
            'short_name' => Yii::t('comp_prep', 'Сокращенное наименование компонента / препарата'),
            'alert_time' => Yii::t('comp_prep', 'alert_time'),
            'infodonor_id' => Yii::t('comp_prep', 'Код организации в Info Donor'),
            'group' => Yii::t('comp_prep', 'Группа'),
            'code' => Yii::t('comp_prep', 'Код'),
            'created_at' => Yii::t('comp_prep', 'Дата создания'),
            'updated_at' => Yii::t('comp_prep', 'Дата редактирования'),
            'status' => Yii::t('comp_prep', 'Статус'),
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

    public function getTypes($type = null)
    {
        $types = [
            1 => 'Компонент',
            2 => 'Препарат'
        ];
        return $type !== null ? $types[$type] : $types;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->status == 1) {
                Yii::$app->cache->delete(self::tableName() . 'getAllForLists' . $this->type);
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
                Yii::$app->cache->delete(self::tableName() . 'getAllForLists' . $this->type);
            }
            return true;
        } else {
            return false;
        }
    }

    public static function getAllForLists($type)
    {
        return self::getCachedKeyValueData(
            self::tableName(),
            ['id', 'name'],
            ['status' => 1, 'type' => $type],
            'getAllForLists' . $type
        );
    }

}