<?php

namespace app\modules\recipient\models;

use Yii;

/**
 * This is the model class for table "recipient_medical_history_analyses".
 *
 * @property integer $id
 * @property integer $recipient_medical_history_id
 * @property integer $hiv_1_result
 * @property string $hiv_1_date
 * @property string $hiv_1_number
 * @property integer $hiv_1_organization_id
 * @property integer $hiv_1_user_id
 * @property integer $hiv_2_result
 * @property string $hiv_2_date
 * @property string $hiv_2_number
 * @property integer $hiv_2_organization_id
 * @property integer $hiv_2_user_id
 * @property integer $hiv_3_result
 * @property string $hiv_3_date
 * @property string $hiv_3_number
 * @property integer $hiv_3_organization_id
 * @property integer $hiv_3_user_id
 * @property integer $status
 *
 * @property Organization $hiv1Organization
 * @property User $hiv1User
 * @property Organization $hiv2Organization
 * @property User $hiv2User
 * @property Organization $hiv3Organization
 * @property User $hiv3User
 * @property RecipientMedicalHistory $recipientMedicalHistory
 */
class MHA extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recipient_medical_history_analyses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recipient_medical_history_id', 'status'], 'required'],
            [['recipient_medical_history_id', 'hiv_1_result', 'hiv_1_date', 'hiv_1_organization_id', 'hiv_1_user_id', 'hiv_2_result', 'hiv_2_date', 'hiv_2_organization_id', 'hiv_2_user_id', 'hiv_3_result', 'hiv_3_date', 'hiv_3_organization_id', 'hiv_3_user_id', 'status'], 'integer'],
            [['hiv_1_number', 'hiv_2_number', 'hiv_3_number'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('recipient', 'ID'),
            'recipient_medical_history_id' => Yii::t('recipient', 'ID истории болезни'),
            'hiv_1_result' => Yii::t('recipient', 'Результаты анализа'),
            'hiv_1_date' => Yii::t('recipient', 'Дата анализа'),
            'hiv_1_number' => Yii::t('recipient', 'Номер анализа'),
            'hiv_1_organization_id' => Yii::t('recipient', 'ID организации'),
            'hiv_1_user_id' => Yii::t('recipient', 'ID пользователя'),
            'hiv_2_result' => Yii::t('recipient', 'Результаты анализа'),
            'hiv_2_date' => Yii::t('recipient', 'Дата анализа'),
            'hiv_2_number' => Yii::t('recipient', 'Номер анализа'),
            'hiv_2_organization_id' => Yii::t('recipient', 'ID организации'),
            'hiv_2_user_id' => Yii::t('recipient', 'ID пользователя'),
            'hiv_3_result' => Yii::t('recipient', 'Результаты анализа'),
            'hiv_3_date' => Yii::t('recipient', 'Дата анализа'),
            'hiv_3_number' => Yii::t('recipient', 'Номер анализа'),
            'hiv_3_organization_id' => Yii::t('recipient', 'ID организации'),
            'hiv_3_user_id' => Yii::t('recipient', 'ID пользователя'),
            'status' => Yii::t('recipient', 'Статус'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHiv1Organization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'hiv_1_organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHiv1User()
    {
        return $this->hasOne(User::className(), ['id' => 'hiv_1_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHiv2Organization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'hiv_2_organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHiv2User()
    {
        return $this->hasOne(User::className(), ['id' => 'hiv_2_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHiv3Organization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'hiv_3_organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHiv3User()
    {
        return $this->hasOne(User::className(), ['id' => 'hiv_3_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipientMedicalHistory()
    {
        return $this->hasOne(RecipientMedicalHistory::className(), ['id' => 'recipient_medical_history_id']);
    }
}
