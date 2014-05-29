<?php

namespace app\modules\catalog\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "mkb10".
 *
 * @property integer $id
 * @property string $f1
 * @property string $f2
 * @property string $f3
 * @property string $icd10
 * @property string $diagnosis
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 */
class Mkb10 extends ActiveRecord
{

    use \app\traits\CachedKeyValueData;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mkb10';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['f1', 'diagnosis'], 'required'],
            [['created_at', 'updated_at', 'status'], 'integer'],
            [['f1', 'f2'], 'string', 'max' => 3],
            [['f3'], 'string', 'max' => 2],
            [['icd10'], 'string', 'max' => 8],
            [['diagnosis'], 'string', 'max' => 254],
            ['status', 'default', 'value' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('mkb10', 'ID'),
            'f1' => Yii::t('mkb10', 'f1'),
            'f2' => Yii::t('mkb10', 'f2'),
            'f3' => Yii::t('mkb10', 'f3'),
            'icd10' => Yii::t('mkb10', 'icd10'),
            'diagnosis' => Yii::t('mkb10', 'Диагноз'),
            'created_at' => Yii::t('mkb10', 'Дата создания'),
            'updated_at' => Yii::t('mkb10', 'Дата редактирования'),
            'status' => Yii::t('mkb10', 'Статус'),
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

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->status == 1) {
                Yii::$app->cache->delete(self::tableName() . 'getAllForLists');
            }
            $this->icd10 = $this->f1 . ($this->f2 ? : '') . ($this->f3 ? '.' . $this->f3 : '');
            return true;
        } else {
            return false;
        }
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            if ($this->status == 1) {
                Yii::$app->cache->delete(self::tableName() . 'getAllForLists');
            }
            return true;
        } else {
            return false;
        }
    }

    public static function getAllForLists()
    {
        return self::getCachedKeyValueData(
            self::tableName(),
            ['id', 'diagnosis'],
            ['status' => 1],
            'getAllForLists'
        );
    }

}