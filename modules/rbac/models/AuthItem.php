<?php

namespace app\modules\rbac\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

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
            \Yii::$app->cache->delete('all-auth-items');
            if ($this->rule_name === '') {
                $this->rule_name = null;
            }
            return true;
        } else {
            return false;
        }
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            \Yii::$app->cache->delete('all-auth-items');
            return true;
        } else {
            return false;
        }
    }

    public static function getAllForLists()
    {
        if (($data = unserialize(\Yii::$app->cache->get('all-auth-items'))) === false) {
            $data = [];
            $models = self::find()->asArray()->select(['name'])->all();
            if ($models) {
                foreach ($models as $model) {
                    $data[$model['name']] = $model['name'];
                }
            }
            \Yii::$app->cache->set('all-auth-items', serialize($data));
        }
        return $data;
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
        if (parent::afterFind()) {
            $this->created_at = date('d/m/Y', $this->created_at);
            $this->updated_at = $this->updated_at ? date('d/m/Y', $this->updated_at) : $this->updated_at;
            return true;
        } else {
            return false;
        }
    }

    public function getTypes($index = false)
    {
        $types = [
            1 => 'Permission (разрешение)',
            2 => 'Role (роль)',
        ];
        return $index === false ? $types : $types[$index];
    }

}
