<?php

namespace app\modules\catalog\models;

use Yii;
use app\modules\organization\models\Organization;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "personal".
 *
 * @property integer $id
 * @property string $surname
 * @property string $name
 * @property string $patronimic
 * @property string $post
 * @property integer $department
 * @property integer $organization_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 */
class Personal extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['surname', 'name', 'department', 'organization_id', 'status'], 'required'],
            [['department', 'organization_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['surname', 'name', 'patronimic', 'post'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('personal', 'ID'),
            'surname' => Yii::t('personal', 'Фамилия'),
            'name' => Yii::t('personal', 'Имя'),
            'patronimic' => Yii::t('personal', 'Отчество'),
            'post' => Yii::t('personal', 'Должность'),
            'department' => Yii::t('personal', 'Отделение'),
            'organization_id' => Yii::t('personal', 'Организация'),
            'created_at' => Yii::t('personal', 'Дата создания'),
            'updated_at' => Yii::t('personal', 'Дата редактирования'),
            'status' => Yii::t('personal', 'Статус'),
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
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

}