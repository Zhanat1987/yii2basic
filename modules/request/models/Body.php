<?php

namespace app\modules\request\models;

use Yii;
use yii\db\ActiveRecord;
use app\modules\catalog\models\CompPrep;
use app\modules\user\models\User;
use yii\db\Query;

/**
 * This is the model class for table "request_body".
 *
 * @property integer $id
 * @property integer $request_header_id
 * @property integer $comp_prep_id
 * @property integer $type
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
 * @property Header $header
 * @property User $user
 */
class Body extends ActiveRecord
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
            [
                [
                    'comp_prep_id',
                    'type',
                    'blood_group',
                    'rh_factor',
                    'volume',
                    'quantity',
                ],
                'required'
            ],
            [
                [
                    'request_header_id',
                    'comp_prep_id',
                    'type',
                    'blood_group',
                    'rh_factor',
                    'volume',
                    'quantity',
                    'user_id',
                    'created_at',
                    'updated_at',
                    'status'
                ],
                'integer'
            ],
            [
                [
                    'phenotype'
                ],
                'string',
                'max' => 8
            ],
            [
                [
                    'status'
                ],
                'default',
                'value' => 1
            ],
        ];
    }

    public function scenarios()
    {
        return [
            'kk' => [
                'comp_prep_id',
                'type',
                'blood_group',
                'rh_factor',
                'phenotype',
                'volume',
                'quantity',
                'status',
            ],
            'pk' => [
                'comp_prep_id',
                'type',
                'volume',
                'quantity',
                'status',
            ],
            // сценарий 'delete' - удаляет запись при вызове метода save()
            'delete-body' => [
                'user_id',
                'status',
            ],
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
            'type' => Yii::t('request', '1 - Компонент, 2 - Препарат'),
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
    public function getCompPrep()
    {
        return $this->hasOne(CompPrep::className(), ['id' => 'comp_prep_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHeader()
    {
        return $this->hasOne(Header::className(), ['id' => 'request_header_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->user_id = Yii::$app->session->get('userId');
            Yii::$app->cache->delete('bodyGetInfo' . $this->request_header_id);
            return true;
        } else {
            return false;
        }
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            if ($this->status == 1) {
                Yii::$app->cache->delete('bodyGetInfo' . $this->request_header_id);
            }
            return true;
        } else {
            return false;
        }
    }

    public function isEmpty($data, $type, $k)
    {
        if ($type == 1) {
            return empty($data['comp_prep_id'][$k]) &&
                empty($data['blood_group'][$k]) && empty($data['rh_factor'][$k]) &&
                empty($data['volume'][$k]) && empty($data['quantity'][$k]);
        } else if ($type == 2) {
            return empty($data['comp_prep_id'][$k]) &&
                empty($data['volume'][$k]) && empty($data['quantity'][$k]);
        }
    }

    public static function getInfo($id)
    {
        if (($data = unserialize(Yii::$app->cache->get('bodyGetInfo' . $id))) === false) {
            $data = [];
            $rows = (new Query)
                ->select(
                    [
                        'comp_prep_id',
                        'type',
                        'blood_group',
                        'rh_factor',
                        'phenotype',
                        'volume',
                        'quantity'
                    ]
                )
                ->from(self::tableName())
                ->where(
                    'request_header_id = :request_header_id AND status = 1',
                    [
                        ':request_header_id' => $id
                    ]
                )
                ->all();
            if ($rows) {
                $compPrep = CompPrep::getAllForLists();
                foreach ($rows as $row) {
                    if ($row['type'] == 1) {
                        $data['kk'][] = [
                            'name' => $compPrep[$row['comp_prep_id']],
                            'volume' => $row['volume'] ? : Yii::t('common', 'нет значения'),
                            'quantity' => $row['quantity'] ? : Yii::t('common', 'нет значения'),
                            'phenotype' => $row['phenotype'] ? : Yii::t('common', 'нет значения'),
                            'blood_group' => $row['blood_group'] ?
                                    Yii::$app->current->getBloodGroup($row['blood_group']) :
                                    Yii::t('common', 'нет значения'),
                            'rh_factor' => $row['rh_factor'] ?
                                    Yii::$app->current->getRhFactor($row['rh_factor']) :
                                    Yii::t('common', 'нет значения'),
                        ];
                    } else if ($row['type'] == 2) {
                        $data['pk'][] = [
                            'name' => $compPrep[$row['comp_prep_id']],
                            'volume' => $row['volume'] ? : Yii::t('common', 'нет значения'),
                            'quantity' => $row['quantity'] ? : Yii::t('common', 'нет значения'),
                        ];
                    }
                }
            }
            Yii::$app->cache->set('bodyGetInfo' . $id, serialize($data), 86400);
        }
        return $data;
    }

}