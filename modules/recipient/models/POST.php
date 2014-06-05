<?php

namespace app\modules\recipient\models;

use Yii;

/**
 * This is the model class for table "recipient_medical_history_postransfusion_epicrisis".
 *
 * @property integer $id
 * @property integer $recipient_medical_history_id
 * @property string $date_transfusion
 * @property integer $type_transfusion
 * @property integer $personal
 * @property string $number_transfusion
 * @property string $arterial_pressure
 * @property string $pulse
 * @property string $temperature
 * @property integer $method_transfusion
 * @property integer $reaction
 * @property string $has_been_reaction
 * @property string $compatibility_room_temperature
 * @property string $compatibility_thermal_samples
 * @property string $compatibility_biological_sample
 * @property string $transfusion_completion_date
 * @property string $transfusion_completion_arterial_pressure
 * @property string $transfusion_completion_pulse
 * @property string $transfusion_completion_temperature_one_hour
 * @property string $transfusion_completion_temperature_two_hour
 * @property string $transfusion_completion_temperature_three_hour
 * @property string $transfusion_completion_color_first_urine
 * @property string $transfusion_completion_daily_urine
 * @property string $transfusion_completion_id_spr_personal
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Personal $personal0
 * @property RecipientMedicalHistory $recipientMedicalHistory
 */
class POST extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recipient_medical_history_postransfusion_epicrisis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recipient_medical_history_id', 'date_transfusion', 'type_transfusion', 'personal', 'method_transfusion', 'reaction', 'transfusion_completion_date', 'created_at', 'updated_at'], 'integer'],
            [['created_at'], 'required'],
            [['number_transfusion', 'arterial_pressure', 'pulse', 'temperature', 'has_been_reaction', 'compatibility_room_temperature', 'compatibility_thermal_samples', 'compatibility_biological_sample', 'transfusion_completion_arterial_pressure', 'transfusion_completion_pulse', 'transfusion_completion_temperature_one_hour', 'transfusion_completion_temperature_two_hour', 'transfusion_completion_temperature_three_hour', 'transfusion_completion_color_first_urine', 'transfusion_completion_daily_urine', 'transfusion_completion_id_spr_personal'], 'string', 'max' => 50]
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
            'date_transfusion' => Yii::t('recipient', 'Дата и время трансфузии'),
            'type_transfusion' => Yii::t('recipient', 'Тип трансфузии'),
            'personal' => Yii::t('recipient', 'Врач'),
            'number_transfusion' => Yii::t('recipient', '№ Трансфузии'),
            'arterial_pressure' => Yii::t('recipient', 'Артериальное давление'),
            'pulse' => Yii::t('recipient', 'Пульс'),
            'temperature' => Yii::t('recipient', 'Температура'),
            'method_transfusion' => Yii::t('recipient', 'Способ переливания'),
            'reaction' => Yii::t('recipient', 'Реакция'),
            'has_been_reaction' => Yii::t('recipient', 'Что сделано в случае реакции'),
            'compatibility_room_temperature' => Yii::t('recipient', 'Комнатная температура'),
            'compatibility_thermal_samples' => Yii::t('recipient', 'Тепловая проба'),
            'compatibility_biological_sample' => Yii::t('recipient', 'Биологическая проба'),
            'transfusion_completion_date' => Yii::t('recipient', 'Время окончания трансфузии'),
            'transfusion_completion_arterial_pressure' => Yii::t('recipient', 'Артериальное давление'),
            'transfusion_completion_pulse' => Yii::t('recipient', 'Пульс; По окончании трансфузии'),
            'transfusion_completion_temperature_one_hour' => Yii::t('recipient', 'Температура через 1 час'),
            'transfusion_completion_temperature_two_hour' => Yii::t('recipient', 'Температура через 2 часа'),
            'transfusion_completion_temperature_three_hour' => Yii::t('recipient', 'Температура через 3 часа'),
            'transfusion_completion_color_first_urine' => Yii::t('recipient', 'Цвет первой мочи'),
            'transfusion_completion_daily_urine' => Yii::t('recipient', 'Суточный диурез'),
            'transfusion_completion_id_spr_personal' => Yii::t('recipient', 'Медсестра'),
            'created_at' => Yii::t('recipient', 'Дата создания'),
            'updated_at' => Yii::t('recipient', 'Дата редактирования'),
        ];
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
    public function getRecipientMedicalHistory()
    {
        return $this->hasOne(RecipientMedicalHistory::className(), ['id' => 'recipient_medical_history_id']);
    }

    public function getMethodsTransfusion($k = null)
    {
        $data = [
            '' => '',
            1 => Yii::t('recipient', 'В/в'),
            2 => Yii::t('recipient', 'капельно'),
            3 => Yii::t('recipient', 'капельно-струйно'),
            4 => Yii::t('recipient', 'струйно'),
        ];
        return $k !== null ? $data[$k] : $data;
    }

    public function getReactions($k = null)
    {
        $data = [
            '' => '',
            1 => Yii::t('recipient', 'без реакции'),
            2 => Yii::t('recipient', 'с реакцией'),
        ];
        return $k !== null ? $data[$k] : $data;
    }

    public function getTypesTransfusion($k = null)
    {
        $data = [
            '' => '',
            1 => Yii::t('recipient', 'первичная'),
            2 => Yii::t('recipient', 'повторная'),
        ];
        return $k !== null ? $data[$k] : $data;
    }

}