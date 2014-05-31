<?php

namespace app\modules\recipient\models;

use Yii;

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
 * @property RecipientInfo $recipientInfo
 * @property Catalog $treatmentOutcome
 * @property RecipientMedicalHistoryAnalyses[] $recipientMedicalHistoryAnalyses
 * @property RecipientMedicalHistoryPostransfusionEpicrisis[] $recipientMedicalHistoryPostransfusionEpicrises
 * @property RecipientMedicalHistoryPretransfusionEpicrisis[] $recipientMedicalHistoryPretransfusionEpicrises
 * @property RecipientMedicalHistorySendTo[] $recipientMedicalHistorySendTos
 */
class MH extends \yii\db\ActiveRecord
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
            [['recipient_info_id', 'number', 'date_receipt', 'mkb10', 'date_discharge', 'treatment_outcome', 'personal', 'convey_place_residence', 'created_at', 'updated_at', 'status'], 'integer'],
            [['number', 'date_receipt', 'created_at', 'status'], 'required'],
            [['hiv_testing', 'hiv_number'], 'string', 'max' => 50]
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
    public function getRecipientInfo()
    {
        return $this->hasOne(RecipientInfo::className(), ['id' => 'recipient_info_id']);
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
    public function getRecipientMedicalHistoryAnalyses()
    {
        return $this->hasMany(RecipientMedicalHistoryAnalyses::className(), ['recipient_medical_history_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipientMedicalHistoryPostransfusionEpicrises()
    {
        return $this->hasMany(RecipientMedicalHistoryPostransfusionEpicrisis::className(), ['recipient_medical_history_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipientMedicalHistoryPretransfusionEpicrises()
    {
        return $this->hasMany(RecipientMedicalHistoryPretransfusionEpicrisis::className(), ['recipient_medical_history_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipientMedicalHistorySendTos()
    {
        return $this->hasMany(RecipientMedicalHistorySendTo::className(), ['recipient_medical_history_id' => 'id']);
    }
}
