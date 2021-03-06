<?php

namespace app\modules\rbac\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "auth_rule".
 *
 * @property string $name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthItem[] $authItems
 */
class AuthRule extends ActiveRecord
{

    use \app\traits\CachedKeyValueData;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'data'], 'required'],
            [['name'], 'unique'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Правило',
            'data' => 'Данные (Имя класса правила)',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItems()
    {
        return $this->hasMany(AuthItem::className(), ['rule_name' => 'name']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            Yii::$app->cache->delete(self::tableName() . 'getAllForLists');
            $ruleClass = "app\\modules\\rbac\\rules\\{$this->data}";
            $this->data = serialize(new $ruleClass);
            return true;
        } else {
            return false;
        }
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            Yii::$app->cache->delete(self::tableName() . 'getAllForLists');
            return true;
        } else {
            return false;
        }
    }

    public static function getAllForLists()
    {
        return self::getCachedKeyValueData(
            self::tableName(),
            ['name'],
            null,
            'getAllForLists',
            ['' => 'Выберите правило']
        );
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

}