<?php

namespace app\modules\waybill\models;

use Yii;
use yii\db\ActiveRecord;
use app\modules\catalog\models\CompPrep;
use app\modules\user\models\User;
use app\modules\bloodstorage\models\BloodStorage;
use yii\db\Query;

/**
 * This is the model class for table "waybill_body".
 *
 * @property integer $id
 * @property integer $waybill_header_id
 * @property integer $comp_prep_id
 * @property string $registration_number
 * @property string $series
 * @property integer $blood_group
 * @property integer $rh_factor
 * @property string $phenotype
 * @property integer $volume
 * @property string $dosage
 * @property string $date_prepare
 * @property string $date_expiration
 * @property string $donor
 * @property integer $user_id
 * @property string $ids
 * @property integer $quantity
 * @property integer $type
 * @property string $microtime
 * @property integer $is_moved
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property integer $oldQuantity
 *
 * @property BloodStorage[] $bloodStorages
 * @property CompPrep $compPrep
 * @property User $user
 * @property Header $header
 */
class Body extends ActiveRecord
{

    public $oldQuantity;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'waybill_body';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'waybill_header_id',
                    'comp_prep_id',
                    'date_prepare',
                    'date_expiration',
                    'type',
                ],
                'required'
            ],
            [
                [
                    'waybill_header_id',
                    'comp_prep_id',
                    'registration_number',
                    'blood_group',
                    'rh_factor',
                    'volume',
                    'user_id',
                    'quantity',
                    'type',
                    'microtime',
                    'is_moved',
                    'created_at',
                    'updated_at',
                    'status'
                ],
                'integer'
            ],
            [['ids'], 'string'],
            [['series', 'dosage'], 'string', 'max' => 50],
            [['microtime', 'is_moved'], 'safe'],
            [
                [
                    'phenotype'
                ],
                'string',
                'max' => 8
            ],
            [['donor'], 'string', 'max' => 200],
            [
                [
                    'status'
                ],
                'default',
                'value' => 1
            ],
            [
                [
                    'quantity'
                ],
                'default',
                'value' => 1,
                'on' => 'kk'
            ],
            ['quantity', 'validatePlusInt', 'on' => 'pk'],
        ];
    }

    public function validatePlusInt($attr, $params)
    {
        if ($this->$attr < 1) {
            $this->addError($attr, 'Поле "' . $this->getAttributeLabel($attr) .
                '" должно быть целым числом большим нуля!!!');
        }
        if ($attr == 'quantity' && !$this->isNewRecord && $this->is_moved) {
            $bss = (new Query())
                ->select('quantity')
                ->from(BloodStorage::tableName())
                ->where('waybill_body_id = ' . $this->id . ' AND type_send != 0')
                ->all();
            $bsCount = 0;
            if ($bss) {
                foreach ($bss as $bs) {
                    $bsCount += $bs['quantity'];
                }
            }
            $minCount = $bsCount ? : $this->oldQuantity;
            if ($this->$attr < $minCount) {
                $this->addError($attr, 'Поле "' . $this->getAttributeLabel($attr) .
                    '" должно быть целым числом большим ' . $minCount . '!!!');
            }
        }
    }

    public function scenarios()
    {
        return [
            'kk' => [
                'registration_number',
                'comp_prep_id',
                'type',
                'blood_group',
                'rh_factor',
                'phenotype',
                'volume',
                'date_prepare',
                'date_expiration',
                'donor',
                'quantity',
                'user_id',
                'status',
            ],
            'pk' => [
                'series',
                'comp_prep_id',
                'type',
                'volume',
                'date_prepare',
                'date_expiration',
                'quantity',
                'user_id',
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
            'id' => Yii::t('waybill', 'ID'),
            'waybill_header_id' => Yii::t('waybill', 'Ключевое поле шапки накладной'),
            'comp_prep_id' => Yii::t('waybill',
                    'Наименование продукции / Наименование препарата (Справочник - Компоненты крови)'),
            'registration_number' => Yii::t('waybill', 'Регистрационный №'),
            'series' => Yii::t('waybill', 'Серия'),
            'blood_group' => Yii::t('waybill', 'Группа крови'),
            'rh_factor' => Yii::t('waybill', 'Резус фактор'),
            'phenotype' => Yii::t('waybill', 'Фенотип'),
            'volume' => Yii::t('waybill', 'Объем'),
            'dosage' => Yii::t('waybill', 'Дозировка'),
            'date_prepare' => Yii::t('waybill', 'Дата заготовки'),
            'date_expiration' => Yii::t('waybill', 'Срок годности'),
            'donor' => Yii::t('waybill', 'Донор'),
            'user_id' => Yii::t('waybill', 'Пользователь'),
            'ids' => Yii::t('waybill', 'Все id одного препарата'),
            'quantity' => Yii::t('waybill', 'Количество'),
            'type' => Yii::t('waybill', '1 - Компонент, 2 - Препарат'),
            'microtime' => Yii::t('waybill', 'Время создания или редактирования'),
            'is_moved' => Yii::t('waybill', 'Перемещен'),
            'created_at' => Yii::t('waybill', 'Дата создания'),
            'updated_at' => Yii::t('waybill', 'Дата редактирования'),
            'status' => Yii::t('waybill', 'Статус'),
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
    public function getBloodStorages()
    {
        return $this->hasMany(BloodStorage::className(), ['waybill_body_id' => 'id']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHeader()
    {
        return $this->hasOne(Header::className(), ['id' => 'waybill_header_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->user_id = Yii::$app->session->get('userId');
            return true;
        } else {
            return false;
        }
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            return true;
        } else {
            return false;
        }
    }

    public function afterFind()
    {
        $this->oldQuantity = $this->quantity;
        return parent::afterFind();
    }

    public function isEmpty($data, $type, $k, $pkIndex)
    {
        if ($type == 1) {
            return empty($data['registration_number'][$k]) &&
                empty($data['comp_prep_id'][$k]) &&
                empty($data['blood_group'][$k]) &&
                empty($data['rh_factor'][$k]) &&
                empty($data['volume'][$k]) &&
                empty($data['date_prepare'][$k]) &&
                empty($data['date_expiration'][$k]) &&
                empty($data['phenotype'][$k]) &&
                empty($data['donor'][$k]);
        } else if ($type == 2) {
            return empty($data['series'][$pkIndex]) &&
                empty($data['comp_prep_id'][$k]) &&
                empty($data['volume'][$k]) &&
                empty($data['quantity'][$pkIndex]) &&
                empty($data['date_prepare'][$k]) &&
                empty($data['date_expiration'][$k]);
        }
    }

}