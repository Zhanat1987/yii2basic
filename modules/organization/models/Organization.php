<?php

namespace app\modules\organization\models;

use Yii;
use app\modules\user\models\User;

/**
 * This is the model class for table "organization".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 */
class Organization extends \yii\db\ActiveRecord
{

    use \app\traits\CachedKeyValueData;

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
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['created_by'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'заголовок',
            'text' => 'текст',
            'created_by' => 'Автор',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->created_by = Yii::$app->user->identity->getId();
            }
            return true;
        } else {
            return false;
        }
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            Yii::$app->authManager->revokeAll($this->id);
            Yii::$app->cache->delete('all-users');
            return true;
        } else {
            return false;
        }
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['organization_id' => 'id']);
    }

    public static function getAllForLists()
    {
        return self::getCachedKeyValueData(
            self::tableName(),
            ['id', 'name'],
            ['status' => 1],
            'getAllForLists'
        );
    }

}
