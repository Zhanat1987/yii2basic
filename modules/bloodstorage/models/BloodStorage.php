<?php

namespace app\modules\bloodstorage\models;

use Yii;
use yii\db\ActiveRecord;
use app\modules\organization\models\Organization;
use app\modules\waybill\models\Body;
use yii\db\Exception;
use app\modules\recipient\models\MH;

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
 * @property Body $body
 * @property Organization $defect0
 * @property Organization $department0
 * @property MH $mh
 */
class BloodStorage extends ActiveRecord
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
            [
                [
                    'waybill_body_id',
                    'type_send',
                ],
                'required'
            ],
            [
                [
                    'waybill_body_id',
                    'type_send',
                    'date_send',
                    'department',
                    'defect',
                    'organization_id',
                    'recipient_medical_history_id',
                    'document_number',
                    'document_date_print',
                    'partial_transfusion',
                    'volume_transfused',
                    'quantity',
                    'type',
                    'keytime',
                    'epicrisis',
                    'id_cdlc_delete',
                    'single_wb',
                    'is_original',
                    'created_at',
                    'updated_at',
                    'status'
                ],
                'integer'
            ],
            [['ids'], 'string'],
            [['recipientkey'], 'string', 'max' => 50],
            [
                [
                    'status',
                    'is_original',
                ],
                'default',
                'value' => 1
            ],
            [
                [
                    'single_wb',
                ],
                'default',
                'value' => 0
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('bloodstorage', 'Код записи'),
            'waybill_body_id' => Yii::t('bloodstorage', 'ID кк/пк из накладной'),
            /**
             * Тип передачи:
             * 0 - банк крови
             * 1 - Отделение
             * 2 - Уничтожение
             * 3 - Бак контроль
             * 4 - Выдача в ЛПУ
             * 5 - Перелевание реципиенту
             */
            'type_send' => Yii::t('bloodstorage', 'Отправлен'),
            'date_send' => Yii::t('bloodstorage', 'Дата отправки'),
            // Выдача в отделение при типе = 1
            'department' => Yii::t('bloodstorage', 'Отделение'),
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
            'keytime' => Yii::t('bloodstorage', 'Метка времени создания recipient key,
                значение не должно превышать 300 секунд (5 минут), от текущего момента'),
            'epicrisis' => Yii::t('bloodstorage', 'Epicrisis'),
            'id_cdlc_delete' => Yii::t('bloodstorage', 'При частичном переливании новая запись на уничтожение'),
            'single_wb' => Yii::t('bloodstorage', 'Single Wb'),
            'is_original' => Yii::t('bloodstorage', 'Is Original'),
            'created_at' => Yii::t('bloodstorage', 'Дата регистрации'),
            'updated_at' => Yii::t('bloodstorage', 'Дата редактирования'),
            'status' => Yii::t('bloodstorage', 'Статус'),
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
    public function getBody()
    {
        return $this->hasOne(Body::className(), ['id' => 'waybill_body_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMh()
    {
        return $this->hasOne(MH::className(), ['id' => 'recipient_medical_history_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->organization_id = Yii::$app->session->get('organizationId');
            }
            return true;
        } else {
            return false;
        }
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            return true;
        } else {
            return false;
        }
    }

    public function afterFind()
    {
//        $this->created_at = Yii::$app->current->getDateTime($this->created_at);
//        if ($this->updated_at) {
//            $this->updated_at = Yii::$app->current->getDateTime($this->updated_at);
//        }
        return parent::afterFind();
    }

    public static function registerWaybill($modelB, $isNewRecord = true)
    {
        try {
            if ($isNewRecord) {
                $model = new static();
                $model->waybill_body_id = $modelB->id;
                $model->type_send = 0;
                $model->quantity = $modelB->quantity;
                $model->type = $modelB->type;
                $model->save();
            } else {
                if ($modelB->quantity != $modelB->oldQuantity) {
                    $model = self::find()
                        ->where('waybill_body_id = ' . $modelB->id . ' AND is_original = 1')
                        ->one();
                    if ($model->type_send != 0) {
                        $model->is_original = 0;
                        $model->single_wb = 1;
                        $model->save();
                        $model = new static();
                        $model->waybill_body_id = $modelB->id;
                        $model->type_send = 0;
                        $model->type = $modelB->type;
                        $model->is_original = 1;
                        $model->single_wb = 1;
                        $model->quantity = abs($modelB->quantity - $modelB->oldQuantity);
                    } else {
                        if ($modelB->quantity > $modelB->oldQuantity) {
                            $model->quantity += $modelB->quantity - $modelB->oldQuantity;
                        } else {
                            $model->quantity -= $modelB->oldQuantity - $modelB->quantity;
                        }
                    }
                    $model->save();
                }
            }
            return true;
        } catch (Exception $e) {
            Yii::$app->debugger->exception($e);
            return false;
        }
    }

    public function getTypesSend($k = null)
    {
        $data = [
            Yii::t('bloodstaorage', 'В банке крови'),
            Yii::t('bloodstaorage', 'В отделении - не использованные'),
            Yii::t('bloodstaorage', 'Уничтоженные'),
            Yii::t('bloodstaorage', 'Бак контроль'),
            Yii::t('bloodstaorage', 'Выданные в ЛПУ'),
            Yii::t('bloodstaorage', 'Перелитые'),
        ];
        return $k !== null ? $data[$k] : $data;
    }

    public function canMove($data)
    {
        /**
         * нельзя кликать в банке крови кк/пк, которые есть в актах
         */
        if (($data->type_send == 0) || (in_array($data->type_send, [1, 2, 3, 4])
                && !$data->document_number && !$data->id_cdlc_delete)) {
            return true;
        }
        return false;
    }

    public function returnToBloodStoragePossible($data)
    {
        if (in_array($data->type_send, array(1, 2, 3, 4))
            && !$data->document_number && !$data->id_cdlc_delete) {
            return true;
        }
        return false;
    }

}