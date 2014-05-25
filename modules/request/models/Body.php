<?php

namespace app\modules\request\models;

use Yii;

/**
 * This is the model class for table "request_body".
 *
 * @property integer $id
 * @property integer $request_header_id
 * @property integer $comp_prep_id
 * @property integer $blood_group
 * @property integer $rh_factor
 * @property string $phenotype
 * @property integer $volume
 * @property integer $quantity
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 *
 * @property CompPrep $compPrep
 * @property RequestHeader $requestHeader
 * @property User $user
 */
class Body extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_body';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_header_id', 'comp_prep_id', 'quantity', 'user_id', 'created_at', 'status'], 'required'],
            [['request_header_id', 'comp_prep_id', 'blood_group', 'rh_factor', 'volume', 'quantity', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['phenotype'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('request', 'Ключевое поле'),
            'request_header_id' => Yii::t('request', 'Заявка'),
            'comp_prep_id' => Yii::t('request', 'Ключевое поле компонента / препарата '),
            'blood_group' => Yii::t('request', 'Группа крови'),
            'rh_factor' => Yii::t('request', 'Резус фактор'),
            'phenotype' => Yii::t('request', 'Фенотип'),
            'volume' => Yii::t('request', 'Объем'),
            'quantity' => Yii::t('request', 'Количество'),
            'user_id' => Yii::t('request', 'Ключевое поле пользователя'),
            'created_at' => Yii::t('request', 'Дата создания'),
            'updated_at' => Yii::t('request', 'Дата редактирования'),
            'status' => Yii::t('request', 'Статус'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompPrep()
    {
        return $this->hasOne(CompPrep::className(), ['id' => 'comp_prep_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestHeader()
    {
        return $this->hasOne(RequestHeader::className(), ['id' => 'request_header_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
