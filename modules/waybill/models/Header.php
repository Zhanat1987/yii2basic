<?php

namespace app\modules\waybill\models;

use Yii;
use app\modules\organization\models\Organization;
use app\modules\user\models\User;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\db\Exception;
use app\modules\bloodstorage\models\BloodStorage;

/**
 * This is the model class for table "waybill_header".
 *
 * @property integer $id
 * @property string $number
 * @property string $date
 * @property integer $request
 * @property integer $user_id
 * @property integer $sender
 * @property integer $organization_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 *
 * @property Body[] $bodies
 * @property User $user
 * @property Organization $organization
 * @property Organization $sender0
 */
class Header extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'waybill_header';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'number',
                    'date'
                ],
                'required'
            ],
            [
                [
                    'number',
                    'request',
                    'user_id',
                    'sender',
                    'organization_id',
                    'status'
                ],
                'integer'
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

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('waybill', 'Код'),
            'number' => Yii::t('waybill', '№ накладной'),
            'date' => Yii::t('waybill', 'Дата накладной'),
            'request' => Yii::t('waybill', 'Код заявки'),
            'user_id' => Yii::t('waybill', 'Пользователь добавивший накладную'),
            'sender' => Yii::t('waybill', 'Организация отправитель накладной (ЦК)'),
            'organization_id' => Yii::t('waybill', 'Организация создавшая накладную'),
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
    public function getBodies()
    {
        return $this->hasMany(Body::className(), ['waybill_header_id' => 'id']);
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
            if ($this->isNewRecord) {
                $this->user_id = Yii::$app->getRequest()->getCookies()->getValue('userId');
                if (Yii::$app->getRequest()->getCookies()->getValue('role') != 'супер-администратор' &&
                    Yii::$app->getRequest()->getCookies()->getValue('role') != 'администратор') {
                    $this->organization_id = Yii::$app->getRequest()->getCookies()->getValue('organizationId');
                }
            }
            if ($this->status == 0) {
                $this->deleteAllFromWb($this->id);
            }
            $this->date = Yii::$app->current->setDate($this->date);
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
        $this->date = Yii::$app->current->getDateTime($this->date);
        $this->created_at = Yii::$app->current->getDateTime($this->created_at);
        if ($this->updated_at) {
            $this->updated_at = Yii::$app->current->getDateTime($this->updated_at);
        }
        return parent::afterFind();
    }

    public function deleteAllFromWb($id)
    {
        try {
            $ids = (new Query())->select('id')
                ->from(Body::tableName())
                ->where(
                    'waybill_header_id = :waybill_header_id',
                    [':waybill_header_id' => $id])
                ->all();
            if ($ids) {
                $wbIds = '';
                foreach ($ids as $wbId) {
                    $wbIds .= $wbId['id'] . ',';
                }
                Yii::$app->db->createCommand()->update(
                    Body::tableName(),
                    ['status' => 0],
                    'waybill_header_id = :waybill_header_id',
                    [':waybill_header_id' => $id]
                )->execute();
                Yii::$app->db->createCommand()->update(
                    BloodStorage::tableName(),
                    ['status' => 0],
                    'waybill_body_id IN (' . rtrim($wbIds, ',') . ')'
                )->execute();
            }
            return true;
        } catch (Exception $e) {
            Yii::$app->debugger->exception($e);
            return false;
        }
    }

    public static function createFromRest($data)
    {
        if ((isset($_SERVER['PHP_AUTH_USER']) &&
                $_SERVER['PHP_AUTH_USER'] == Yii::$app->params['restUser']) &&
            (isset($_SERVER['PHP_AUTH_PW']) &&
                $_SERVER['PHP_AUTH_PW'] == Yii::$app->params['restPassword'])) {
            $header = new static();
            $header->setAttributes($data['waybill_header']);
            $wbsKK = $data['waybill_body']['kk'];
            $wbsPK = $data['waybill_body']['pk'];
            try {
                $header->save(false);
                if ($wbsKK) {
                    foreach ($wbsKK as $wbKK) {
                        $modelKK = new Body;
                        $modelKK->scenario = 'kk';
                        $modelKK->type = 1;
                        $modelKK->waybill_header_id = $header->id_waybill_header;
                        /**
                         * $wbKK:
                         * array(
                         *      'WaybillBody' => array(
                         *          'paramName1' => 'paramValue1',
                         *          'paramName2' => 'paramValue2',
                         *          .....
                         *      )
                         * )
                         */
                        $modelKK->setAttributes($wbKK);
                        $modelKK->save(false);
                        BloodStorage::registerWaybill($modelKK);
                    }
                }
                if ($wbsPK) {
                    foreach ($wbsPK as $wbPK) {
                        $modelPK = new Body;
                        $modelPK->scenario = 'pk';
                        $modelPK->type = 2;
                        $modelPK->waybill_header_id = $header->id_waybill_header;
                        /**
                         * $wbPK:
                         * array(
                         *      'WaybillBody' => array(
                         *          'paramName1' => 'paramValue1',
                         *          'paramName2' => 'paramValue2',
                         *          .....
                         *      )
                         * )
                         */
                        $modelPK->setAttributes($wbPK);
                        $modelPK->save(false);
                        BloodStorage::registerWaybill($modelPK);

                    }
                }
                $response = array(
                    'status' => 200,
                    'msg' => 'Все ништяк!!!'
                );
            } catch (Exception $e) {
                $response = array(
                    'status' => 500,
                    'msg' => 'Не верно указаны данные для создания накладной!!!',
                    'error' => $e->getMessage()
                );
            }
        } else {
            $response = array(
                'status' => 401,
                'msg' => 'Не верно указаны логин и пароль!!!'
            );
        }
        return $response;
    }

}