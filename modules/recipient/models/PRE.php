<?php

namespace app\modules\recipient\models;

use Yii;

/**
 * This is the model class for table "recipient_medical_history_pretransfusion_epicrisis".
 *
 * @property integer $id
 * @property integer $recipient_medical_history_id
 * @property integer $indications_transfusion
 * @property string $date_transfusion
 * @property integer $personal
 * @property integer $bcc
 * @property integer $height
 * @property integer $weight
 * @property integer $general_condition
 * @property integer $skin
 * @property integer $statement
 * @property string $comps_drugs
 * @property integer $comps_drugs_count
 * @property integer $massive_blood_loss
 * @property string $reason
 * @property integer $deficit_bcc
 * @property integer $hemorrhage
 * @property string $arterial_pressure
 * @property string $pulse
 * @property string $temperature
 * @property string $date_uac
 * @property string $hb
 * @property string $ht
 * @property string $erythrocytes
 * @property string $stage_dic_syndromes
 * @property string $stage_dic_syndromes_reason
 * @property string $date_coagulation
 * @property string $aptt
 * @property string $ptv
 * @property string $pti
 * @property string $fibrinogen
 * @property string $sfmc
 * @property string $fibrinolysis
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Personal $personal0
 * @property RecipientMedicalHistory $recipientMedicalHistory
 * @property Catalog $statement0
 */
class PRE extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recipient_medical_history_pretransfusion_epicrisis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recipient_medical_history_id', 'indications_transfusion', 'date_transfusion', 'personal', 'bcc', 'height', 'weight', 'general_condition', 'skin', 'statement', 'comps_drugs_count', 'massive_blood_loss', 'deficit_bcc', 'hemorrhage', 'date_uac', 'date_coagulation', 'created_at', 'updated_at'], 'integer'],
            [['comps_drugs'], 'string'],
            [['created_at'], 'required'],
            [['reason', 'arterial_pressure', 'pulse', 'temperature', 'hb', 'ht', 'erythrocytes', 'stage_dic_syndromes', 'stage_dic_syndromes_reason', 'aptt', 'ptv', 'pti', 'fibrinogen', 'sfmc', 'fibrinolysis'], 'string', 'max' => 50]
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
            'indications_transfusion' => Yii::t('recipient', 'Показания для переливания; выпадающий список (Эритроцитсодержащие КК/Свежезамороженная плазма/Препараты крови)'),
            'date_transfusion' => Yii::t('recipient', 'Дата'),
            'personal' => Yii::t('recipient', 'Врач'),
            'bcc' => Yii::t('recipient', 'ОЦК (л.) '),
            'height' => Yii::t('recipient', 'Рост (см.)'),
            'weight' => Yii::t('recipient', 'Вес (кг.)'),
            'general_condition' => Yii::t('recipient', 'Общее состояние; (крайне тяжелое/тяжелое/средней тяжести)'),
            'skin' => Yii::t('recipient', 'Кожный покров; (бледный/желтушный/обычной окраски/геморрагическая сыпь)'),
            'statement' => Yii::t('recipient', 'Показания; справочник'),
            'comps_drugs' => Yii::t('recipient', 'Показано переливание КК; Количество; перечисление через точку с запятой'),
            'comps_drugs_count' => Yii::t('recipient', 'Показано переливание КК; Количество'),
            'massive_blood_loss' => Yii::t('recipient', 'Острая массовая кровопотеря'),
            'reason' => Yii::t('recipient', 'Причина; Причина чего?! кровопотери?'),
            'deficit_bcc' => Yii::t('recipient', 'Дефицит ОЦК, %'),
            'hemorrhage' => Yii::t('recipient', 'Кровопотеря (мл.)'),
            'arterial_pressure' => Yii::t('recipient', 'АД; Артериальное давление'),
            'pulse' => Yii::t('recipient', 'Пульс'),
            'temperature' => Yii::t('recipient', 'Температура'),
            'date_uac' => Yii::t('recipient', 'Дата ОАК'),
            'hb' => Yii::t('recipient', 'Hb'),
            'ht' => Yii::t('recipient', 'Ht'),
            'erythrocytes' => Yii::t('recipient', 'Эритроциты'),
            'stage_dic_syndromes' => Yii::t('recipient', 'Стадия острого ДВС синдрома'),
            'stage_dic_syndromes_reason' => Yii::t('recipient', 'Причина;'),
            'date_coagulation' => Yii::t('recipient', 'Дата коагулограммы'),
            'aptt' => Yii::t('recipient', 'АПТВ'),
            'ptv' => Yii::t('recipient', 'ПТВ'),
            'pti' => Yii::t('recipient', 'ПТИ'),
            'fibrinogen' => Yii::t('recipient', 'Фибриноген'),
            'sfmc' => Yii::t('recipient', 'РФМК'),
            'fibrinolysis' => Yii::t('recipient', 'Фибринолиз'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatement0()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'statement']);
    }
}
