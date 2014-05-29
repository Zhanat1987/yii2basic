<?php

namespace app\modules\bloodstorage\models;

use Yii;

/**
 * This is the model class for table "blood_storage".
 *
 * @property integer $id
 * @property integer $waybill_body_id
 * @property integer $type_send
 * @property string $date_send
 * @property integer $department
 * @property integer $defect
 * @property integer $organization_id
 * @property integer $recipient_medical_history_id
 * @property integer $document_number
 * @property string $document_date_print
 * @property integer $partial_transfusion
 * @property integer $volume_transfused
 * @property string $ids
 * @property integer $quantity
 * @property integer $type
 * @property string $recipientkey
 * @property string $keytime
 * @property integer $epicrisis
 * @property integer $id_cdlc_delete
 * @property integer $single_wb
 * @property integer $is_original
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 *
 * @property WaybillBody $waybillBody
 * @property Organization $defect0
 * @property Organization $department0
 */
class BloodStorage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blood_storage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['waybill_body_id', 'type_send', 'single_wb', 'is_original', 'created_at', 'status'], 'required'],
            [['waybill_body_id', 'type_send', 'date_send', 'department', 'defect', 'organization_id', 'recipient_medical_history_id', 'document_number', 'document_date_print', 'partial_transfusion', 'volume_transfused', 'quantity', 'type', 'keytime', 'epicrisis', 'id_cdlc_delete', 'single_wb', 'is_original', 'created_at', 'updated_at', 'status'], 'integer'],
            [['ids'], 'string'],
            [['recipientkey'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('bloodstorage', 'Ключевое поле'),
            'waybill_body_id' => Yii::t('bloodstorage', 'ID кк/пк из накладной'),
            'type_send' => Yii::t('bloodstorage', 'Тип передачи: 1-Отделение; 2-Уничтожение; 3-Бак контроль; 4-Выдача в ЛПУ; 5-Перелевание реципиенту'),
            'date_send' => Yii::t('bloodstorage', 'Дата отправки'),
            'department' => Yii::t('bloodstorage', 'Выдача в отделение при типе = 1'),
            'defect' => Yii::t('bloodstorage', 'Причина уничтожения при типе = 2'),
            'organization_id' => Yii::t('bloodstorage', 'Назад в ЛПУ при типе = 4'),
            'recipient_medical_history_id' => Yii::t('bloodstorage', 'Ключевое поле истории болезни'),
            'document_number' => Yii::t('bloodstorage', 'Номер накладной или акта'),
            'document_date_print' => Yii::t('bloodstorage', 'Дата печати накладной или акта'),
            'partial_transfusion' => Yii::t('bloodstorage', 'Признак частичного переливания'),
            'volume_transfused' => Yii::t('bloodstorage', 'Объем уничтоженной продукции'),
            'ids' => Yii::t('bloodstorage', 'Ids'),
            'quantity' => Yii::t('bloodstorage', 'Количество'),
            'type' => Yii::t('bloodstorage', '1 - Компонент, 2 - Препарат'),
            'recipientkey' => Yii::t('bloodstorage', 'Recipientkey'),
            'keytime' => Yii::t('bloodstorage', 'Метка времени создания recipient key, значение                     не должно превышать 300 секунд (5 минут), от текущего момента'),
            'epicrisis' => Yii::t('bloodstorage', 'Epicrisis'),
            'id_cdlc_delete' => Yii::t('bloodstorage', 'При частичном переливании новая запись на уничтожение'),
            'single_wb' => Yii::t('bloodstorage', 'Single Wb'),
            'is_original' => Yii::t('bloodstorage', 'Is Original'),
            'created_at' => Yii::t('bloodstorage', 'Дата создания'),
            'updated_at' => Yii::t('bloodstorage', 'Дата редактирования'),
            'status' => Yii::t('bloodstorage', 'Статус'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWaybillBody()
    {
        return $this->hasOne(WaybillBody::className(), ['id' => 'waybill_body_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDefect0()
    {
        return $this->hasOne(Organization::className(), ['id' => 'defect']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment0()
    {
        return $this->hasOne(Organization::className(), ['id' => 'department']);
    }
}
