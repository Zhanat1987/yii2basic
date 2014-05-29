<?php

namespace app\modules\waybill\models;

use Yii;
use yii\db\ActiveRecord;
use app\modules\catalog\models\CompPrep;
use app\modules\user\models\User;
use app\modules\bloodstorage\models\BloodStorage;

/**
 * This is the model class for table "waybill_body".
 *
 * @property integer $id
 * @property integer $waybill_header_id
 * @property integer $comp_prep_id
 * @property string $registration_number
 * @property string $series
 * @property integer $blood_group
 * @property integer $rh_factor
 * @property string $phenotype
 * @property integer $volume
 * @property string $dosage
 * @property string $date_prepare
 * @property string $date_expiration
 * @property string $donor
 * @property integer $user_id
 * @property string $ids
 * @property integer $quantity
 * @property integer $type
 * @property string $microtime
 * @property integer $is_moved
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 *
 * @property BloodStorage[] $bloodStorages
 * @property CompPrep $compPrep
 * @property User $user
 * @property Header $header
 */
class Body extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'waybill_body';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['waybill_header_id', 'comp_prep_id', 'date_prepare', 'type', 'microtime', 'is_moved', 'created_at', 'status'], 'required'],
            [['waybill_header_id', 'comp_prep_id', 'registration_number', 'blood_group', 'rh_factor', 'volume', 'date_prepare', 'date_expiration', 'user_id', 'quantity', 'type', 'microtime', 'is_moved', 'created_at', 'updated_at', 'status'], 'integer'],
            [['ids'], 'string'],
            [['series', 'dosage'], 'string', 'max' => 50],
            [['phenotype'], 'string', 'max' => 100],
            [['donor'], 'string', 'max' => 200],
            [
                [
                    'status'
                ],
                'default',
                'value' => 1
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('waybill', 'ID'),
            'waybill_header_id' => Yii::t('waybill', 'Ключевое поле шапки накладной'),
            'comp_prep_id' => Yii::t('waybill', 'Наименование продукции / Наименование препарата (Справочник - Компоненты крови)'),
            'registration_number' => Yii::t('waybill', 'Регистрационный №'),
            'series' => Yii::t('waybill', 'Серия'),
            'blood_group' => Yii::t('waybill', 'Группа крови'),
            'rh_factor' => Yii::t('waybill', 'Резус фактор'),
            'phenotype' => Yii::t('waybill', 'Фенотип'),
            'volume' => Yii::t('waybill', 'Объем'),
            'dosage' => Yii::t('waybill', 'Дозировка'),
            'date_prepare' => Yii::t('waybill', 'Дата заготовки'),
            'date_expiration' => Yii::t('waybill', 'Срок годности'),
            'donor' => Yii::t('waybill', 'Донор'),
            'user_id' => Yii::t('waybill', 'Пользователь'),
            'ids' => Yii::t('waybill', 'Все id одного препарата'),
            'quantity' => Yii::t('waybill', 'Количество'),
            'type' => Yii::t('waybill', '1 - Компонент, 2 - Препарат'),
            'microtime' => Yii::t('waybill', 'Время создания или редактирования'),
            'is_moved' => Yii::t('waybill', 'Перемещен'),
            'created_at' => Yii::t('waybill', 'Дата создания'),
            'updated_at' => Yii::t('waybill', 'Дата редактирования'),
            'status' => Yii::t('waybill', 'Статус'),
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
    public function getBloodStorages()
    {
        return $this->hasMany(BloodStorage::className(), ['waybill_body_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompPrep()
    {
        return $this->hasOne(CompPrep::className(), ['id' => 'comp_prep_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWaybillHeader()
    {
        return $this->hasOne(WaybillHeader::className(), ['id' => 'waybill_header_id']);
    }
}
