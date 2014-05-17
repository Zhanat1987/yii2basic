<?php

namespace app\modules\rbac\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use app\myhelpers\Current;
use yii\rbac\Item;

/**
 * This is the model class for table "auth_item".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthAssignment $authAssignment
 * @property AuthRule $ruleName
 * @property AuthItemChild $authItemChild
 */
class AuthItem extends ActiveRecord
{

    use \app\traits\CachedKeyValueData;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            ['name', 'unique'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['data'], 'default', 'value' => null],
            [['name', 'rule_name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => "Имя item'а",
            'type' => 'Тип',
            'description' => 'Описание',
            'rule_name' => 'Имя правила',
            'data' => 'Data',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата редактирования',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignment()
    {
        return $this->hasOne(AuthAssignment::className(), ['item_name' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(AuthRule::className(), ['name' => 'rule_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChild()
    {
        return $this->hasOne(AuthItemChild::className(), ['child' => 'name']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            Yii::$app->cache->delete(self::tableName() . 'getAllForLists');
            Yii::$app->cache->delete(self::tableName() . 'getAllForLists2');
            if ($this->type == 1) {
                Yii::$app->cache->delete(self::tableName() . 'getRoles');
            }
            if ($this->rule_name === '') {
                $this->rule_name = null;
            }
            /**
             * надо сериализовать данные для правила
             */
            if ($this->data) {
                $this->data = serialize($this->data);
            }
            return true;
        } else {
            return false;
        }
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            Yii::$app->cache->delete(self::tableName() . 'getAllForLists');
            Yii::$app->cache->delete(self::tableName() . 'getAllForLists2');
            if ($this->type == 1) {
                Yii::$app->cache->delete(self::tableName() . 'getRoles');
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
            ['name'],
            null,
            'getAllForLists'
        );
    }

    public static function getAllForLists2()
    {
        return self::getCachedKeyValueData(
            self::tableName(),
            ['name', 'description'],
            null,
            'getAllForLists'
        );
    }

    public static function getRoles()
    {
        return self::getCachedKeyValueData(
            self::tableName(),
            ['name'],
            ['type' => Item::TYPE_ROLE],
            'getRoles'
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

    public function afterFind()
    {
        $this->created_at = Current::getDate($this->created_at);
        $this->updated_at = Current::getDate($this->updated_at);
        if ($this->data) {
            $this->data = unserialize($this->data);
        }
        return parent::afterFind();
    }

    public function getTypes($type = null)
    {
        $types = [
            Item::TYPE_ROLE => 'Role (роль)',
            Item::TYPE_PERMISSION => 'Permission (разрешение)',
        ];
        return $type !== null ? $types[$type] : $types;
    }

    public function getTypesForGridFilter()
    {
        return Current::filterDefaultValue($this->getTypes());
    }

}
