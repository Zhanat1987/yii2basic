<?php

namespace app\modules\waybill\models;

use Yii;
use app\modules\organization\models\Organization;
use app\modules\user\models\User;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "waybill_header".
 *
 * @property integer $id
 * @property string $number
 * @property string $date
 * @property integer $request
 * @property integer $user_id
 * @property integer $sender
 * @property integer $organization_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 *
 * @property Body[] $bodies
 * @property User $user
 * @property Organization $organization
 * @property Organization $sender0
 */
class Header extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'waybill_header';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'number',
                    'date'
                ],
                'required'
            ],
            [
                [
                    'number',
                    'request',
                    'user_id',
                    'sender',
                    'organization_id',
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
            'id' => Yii::t('waybill', 'Код'),
            'number' => Yii::t('waybill', '№ накладной'),
            'date' => Yii::t('waybill', 'Дата накладной'),
            'request' => Yii::t('waybill', 'Код заявки'),
            'user_id' => Yii::t('waybill', 'Пользователь добавивший накладную'),
            'sender' => Yii::t('waybill', 'Организация отправитель накладной (ЦК)'),
            'organization_id' => Yii::t('waybill', 'Организация создавшая накладную'),
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
    public function getBodies()
    {
        return $this->hasMany(Body::className(), ['waybill_header_id' => 'id']);
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
            if ($this->isNewRecord) {
                $this->user_id = Yii::$app->session->get('userId');
                if (Yii::$app->session->get('role') != 'супер-администратор' &&
                    Yii::$app->session->get('role') != 'администратор') {
                    $this->organization_id = Yii::$app->session->get('organizationId');
                }
            }
            $this->date = Yii::$app->current->setDate($this->date);
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
        $this->date = Yii::$app->current->getDateTime($this->date);
        $this->created_at = Yii::$app->current->getDateTime($this->created_at);
        if ($this->updated_at) {
            $this->updated_at = Yii::$app->current->getDateTime($this->updated_at);
        }
        return parent::afterFind();
    }

}