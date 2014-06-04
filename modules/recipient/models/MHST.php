<?php

namespace app\modules\recipient\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use app\modules\organization\models\Organization;
use app\modules\user\models\User;

/**
 * This is the model class for table "recipient_medical_history_send_to".
 *
 * @property integer $id
 * @property integer $recipient_medical_history_id
 * @property string $date_send
 * @property string $date_receive
 * @property integer $receiver
 * @property integer $user_id
 * @property integer $organization_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 *
 * @property Organization $organization
 * @property Organization $receiver0
 * @property MH $recipientMedicalHistory
 * @property User $user
 */
class MHST extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recipient_medical_history_send_to';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'recipient_medical_history_id',
                    'date_send',
                    'date_receive',
                    'receiver',
                    'user_id',
                    'organization_id',
                    'created_at',
                    'updated_at',
                    'status'
                ],
                'integer'
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
            'recipient_medical_history_id' => Yii::t('recipient', 'ID истории болезни'),
            'date_send' => Yii::t('recipient', 'Дата передачи реципиента'),
            'date_receive' => Yii::t('recipient', 'Дата приема реципиента'),
            'receiver' => Yii::t('recipient', 'Организация передачи'),
            'user_id' => Yii::t('recipient', 'ID пользователя'),
            'organization_id' => Yii::t('recipient', 'ID организации'),
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
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver0()
    {
        return $this->hasOne(Organization::className(), ['id' => 'receiver']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedicalHistory()
    {
        return $this->hasOne(MH::className(), ['id' => 'recipient_medical_history_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->user_id = Yii::$app->getRequest()->getCookies()->getValue('userId');
            $this->organization_id = Yii::$app->getRequest()->getCookies()->getValue('organizationId');
            return true;
        } else {
            return false;
        }
    }

}