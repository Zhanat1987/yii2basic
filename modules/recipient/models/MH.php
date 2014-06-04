<?php

namespace app\modules\recipient\models;

use Yii;
use app\modules\bloodstorage\models\BloodStorage;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use app\modules\catalog\models\Personal;
use app\modules\catalog\models\Catalog;
use app\modules\catalog\models\Mkb10;

/**
 * This is the model class for table "recipient_medical_history".
 *
 * @property integer $id
 * @property integer $recipient_info_id
 * @property integer $number
 * @property string $date_receipt
 * @property integer $mkb10
 * @property string $hiv_testing
 * @property string $hiv_number
 * @property string $date_discharge
 * @property integer $treatment_outcome
 * @property integer $personal
 * @property integer $convey_place_residence
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 *
 * @property BloodStorage[] $bloodStorages
 * @property Mkb10 $mkb100
 * @property Personal $personal0
 * @property Info $info
 * @property Catalog $treatmentOutcome
 * @property MHA[] $recipientMedicalHistoryAnalyses
 * @property POST[] $recipientMedicalHistoryPostransfusionEpicrises
 * @property PRE[] $recipientMedicalHistoryPretransfusionEpicrises
 * @property MHST[] $recipientMedicalHistorySendTos
 */
class MH extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recipient_medical_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'recipient_info_id',
                    'number',
                    'mkb10',
                    'treatment_outcome',
                    'personal',
                    'convey_place_residence',
                    'created_at',
                    'updated_at',
                    'status'
                ],
                'integer'
            ],
            [
                [
                    'number',
                    'date_receipt'
                ],
                'required'
            ],
            [
                [
                    'hiv_testing',
                    'hiv_number'
                ],
                'string',
                'max' => 50
            ],
            [
                [
                    'date_receipt',
                    'date_discharge',
                ],
                'safe'
            ],
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
            'id' => Yii::t('recipient', 'ID'),
            'recipient_info_id' => Yii::t('recipient', 'Личная информация'),
            'number' => Yii::t('recipient', '№ истории болезни'),
            'date_receipt' => Yii::t('recipient', 'Дата поступления'),
            'mkb10' => Yii::t('recipient', 'Код диагноза по МКБ'),
            'hiv_testing' => Yii::t('recipient', 'Обследование на ВИЧ'),
            'hiv_number' => Yii::t('recipient', '№ исследования на ВИЧ'),
            'date_discharge' => Yii::t('recipient', 'Дата выписки'),
            'treatment_outcome' => Yii::t('recipient', 'Исход лечения '),
            'personal' => Yii::t('recipient', 'ФИО медработника'),
            'convey_place_residence' => Yii::t('recipient', 'Передать по месту жительства'),
            'created_at' => Yii::t('recipient', 'Дата создания'),
            'updated_at' => Yii::t('recipient', 'Дата редактирования'),
            'status' => Yii::t('recipient', 'Статус'),
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBloodStorages()
    {
        return $this->hasMany(BloodStorage::className(), ['recipient_medical_history_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMkb100()
    {
        return $this->hasOne(Mkb10::className(), ['id' => 'mkb10']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonal0()
    {
        return $this->hasOne(Personal::className(), ['id' => 'personal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInfo()
    {
        return $this->hasOne(Info::className(), ['id' => 'recipient_info_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTreatmentOutcome()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'treatment_outcome']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicalHistoryAnalyses()
    {
        return $this->hasMany(MHA::className(), ['recipient_medical_history_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicalHistoryPostransfusionEpicrises()
    {
        return $this->hasMany(POST::className(), ['recipient_medical_history_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicalHistoryPretransfusionEpicrises()
    {
        return $this->hasMany(PRE::className(), ['recipient_medical_history_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicalHistorySendTos()
    {
        return $this->hasMany(MHST::className(), ['recipient_medical_history_id' => 'id']);
    }

}