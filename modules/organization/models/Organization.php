<?php

namespace app\modules\organization\models;

use Yii;

/**
 * This is the model class for table "organization".
 *
 * @property integer $id
 * @property string $name
 * @property string $short_name
 * @property integer $region_id
 * @property integer $region_area_id
 * @property integer $city_id
 * @property integer $street_id
 * @property string $home_number
 * @property string $phone
 * @property string $email
 * @property string $url
 * @property string $chief_phone
 * @property string $chief_email
 * @property integer $infodonor_id
 * @property integer $bin
 * @property string $curl
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 */
class Organization extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'short_name', 'created_at', 'status'], 'required'],
            [['region_id', 'region_area_id', 'city_id', 'street_id', 'infodonor_id', 'bin', 'created_at', 'updated_at', 'status'], 'integer'],
            [['name', 'short_name', 'home_number', 'phone', 'email', 'url', 'chief_phone', 'chief_email', 'curl'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('organization', 'ID'),
            'name' => Yii::t('organization', 'Наименование организации'),
            'short_name' => Yii::t('organization', 'Сокращенное наименование организации'),
            'region_id' => Yii::t('organization', 'Область'),
            'region_area_id' => Yii::t('organization', 'Административная единица области'),
            'city_id' => Yii::t('organization', 'Город'),
            'street_id' => Yii::t('organization', 'Улица'),
            'home_number' => Yii::t('organization', '№ дома'),
            'phone' => Yii::t('organization', 'Телефон приемной организации'),
            'email' => Yii::t('organization', 'Е-mail приемной органищации'),
            'url' => Yii::t('organization', 'Сайт организации'),
            'chief_phone' => Yii::t('organization', 'Телефон директора'),
            'chief_email' => Yii::t('organization', 'Е-mail директора'),
            'infodonor_id' => Yii::t('organization', 'Код организации в Info Donor'),
            'bin' => Yii::t('organization', 'БИН'),
            'curl' => Yii::t('organization', 'URL для запроса о КК/ПК'),
            'created_at' => Yii::t('organization', 'Дата создания'),
            'updated_at' => Yii::t('organization', 'Дата редактирования'),
            'status' => Yii::t('organization', 'Статус'),
        ];
    }
}
