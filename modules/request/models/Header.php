<?php

namespace app\modules\request\models;

use Yii;
use app\modules\organization\models\Organization;
use app\modules\catalog\models\Catalog;
use app\modules\user\models\User;

/**
 * This is the model class for table "request_header".
 *
 * @property integer $id
 * @property string $request_date
 * @property integer $urgency
 * @property integer $type
 * @property integer $personal
 * @property integer $target
 * @property integer $receiver
 * @property string $execution_date
 * @property string $required_date
 * @property integer $request_status
 * @property integer $user_id
 * @property integer $organization_id
 * @property integer $was_read
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 *
 * @property RequestBody[] $requestBodies
 * @property Organization $organization
 * @property Catalog $personal0
 * @property Organization $receiver0
 * @property Catalog $target0
 * @property User $user
 */
class Header extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_header';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_date', 'urgency', 'type', 'personal', 'target', 'receiver', 'request_status', 'user_id', 'organization_id', 'created_at', 'status'], 'required'],
            [['request_date', 'urgency', 'type', 'personal', 'target', 'receiver', 'execution_date', 'required_date', 'request_status', 'user_id', 'organization_id', 'was_read', 'created_at', 'updated_at', 'status'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('request', 'Ключевое поле'),
            'request_date' => Yii::t('request', 'Дата и время формирования'),
            'urgency' => Yii::t('request', 'Срочность'),
            'type' => Yii::t('request', 'Вид заявки'),
            'personal' => Yii::t('request', 'Ответственное лицо'),
            'target' => Yii::t('request', 'Основание (цель)'),
            'receiver' => Yii::t('request', 'Организация получатель заявки'),
            'execution_date' =>
                Yii::t('request', 'Дата запрашиваемого исполнения, Время запрашиваемого исполнения'),
            'required_date' => Yii::t('request', 'Требуемый срок исполнения '),
            'request_status' => Yii::t('request', 'Статус заявки'),
            'user_id' => Yii::t('request', 'Ключевое поле пользователя'),
            'organization_id' => Yii::t('request', 'Организация создавшая запись'),
            'was_read' => Yii::t('request', 'Прочитано'),
            'created_at' => Yii::t('request', 'Дата создания'),
            'updated_at' => Yii::t('request', 'Дата редактирования'),
            'status' => Yii::t('request', 'Статус'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBodies()
    {
        return $this->hasMany(Body::className(), ['request_header_id' => 'id']);
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
    public function getPersonal0()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'personal']);
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
    public function getTarget0()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'target']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getStatuses($k = null)
    {
        $statuses = ['Не исполненные', 'Исполненные'];
        return $k !== null ? $statuses[$k] : $statuses;
    }

}