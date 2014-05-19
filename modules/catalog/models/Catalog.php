<?php

namespace app\modules\catalog\models;

use Yii;
use app\modules\organization\models\Organization;

/**
 * This is the model class for table "catalog".
 *
 * @property integer $id
 * @property string $name
 * @property integer $organization_id
 * @property integer $type
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 */
class Catalog extends \yii\db\ActiveRecord
{

    use \app\traits\CachedKeyValueData;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'created_at', 'status'], 'required'],
            [['organization_id', 'type', 'created_at', 'updated_at', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('catalog', 'ID'),
            'name' => Yii::t('catalog', 'Название'),
            'organization_id' => Yii::t('catalog', 'Организация'),
            'type' => Yii::t('catalog', 'Тип'),
            'created_at' => Yii::t('catalog', 'Дата создания'),
            'updated_at' => Yii::t('catalog', 'Дата редактирования'),
            'status' => Yii::t('catalog', 'Статус'),
        ];
    }

    public function getOrganizations()
    {
        return $this->hasMany(Organization::className(), ['organization_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->status == 1) {
                $cache = Yii::$app->cache;
                $cache->delete(self::tableName() . 'getAllForLists');
                $cache->delete(self::tableName() . 'getAllForLists' . $this->type);
                if ($this->organization_id) {
                    $cache->delete(self::tableName() . 'getAllForLists' .
                        $this->type . $this->organization_id);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            if ($this->status == 1) {
                $cache = Yii::$app->cache;
                $cache->delete(self::tableName() . 'getAllForLists');
                $cache->delete(self::tableName() . 'getAllForLists' . $this->type);
                if ($this->organization_id) {
                    $cache->delete(self::tableName() . 'getAllForLists' .
                        $this->type . $this->organization_id);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public static function getAllForLists($type = null, $organization = null)
    {
        $where['status'] = 1;
        $key = 'getAllForLists';
        if ($type !== null) {
            $where['type'] = $type;
            $key .= $type;
            if ($organization !== null) {
                $where['organization_id'] = $organization;
                $key .= $organization;
            }
        }
        return self::getCachedKeyValueData(
            self::tableName(),
            ['id', 'name'],
            $where,
            $key
        );
    }

}