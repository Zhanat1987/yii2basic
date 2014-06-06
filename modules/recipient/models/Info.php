<?php

namespace app\modules\recipient\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "recipient_info".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property integer $sex
 * @property string $birthday
 * @property integer $citizenship
 * @property integer $type_residence
 * @property integer $iin
 * @property integer $organization_id
 * @property integer $blood_group
 * @property integer $rh_factor
 * @property integer $document_types
 * @property string $document_number
 * @property string $document_series
 * @property string $document_date_issue
 * @property string $document_issued
 * @property string $document_date_expiration
 * @property integer $homeless
 * @property integer $addr_reg_addr_region_id
 * @property integer $addr_reg_addr_region_area_id
 * @property integer $addr_reg_addr_city_id
 * @property string $addr_reg_street_id
 * @property string $addr_reg_home
 * @property string $addr_reg_flat
 * @property integer $addr_res_addr_region_id
 * @property integer $addr_res_addr_region_area_id
 * @property integer $addr_res_addr_city_id
 * @property string $addr_res_street_id
 * @property string $addr_res_home
 * @property string $addr_res_flat
 * @property string $work_name
 * @property string $work_department
 * @property string $work_post
 * @property string $work_phone
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 *
 * @property Catalog $citizenship0
 * @property Catalog $documentTypes
 * @property Organization $organization
 * @property Catalog $addrRegAddrCity
 * @property Catalog $addrRegAddrRegionArea
 * @property Catalog $addrRegAddrRegion
 * @property Catalog $addrResAddrCity
 * @property Catalog $addrResAddrRegionArea
 * @property Catalog $addrResAddrRegion
 * @property User $user
 * @property MedicalHistory[] $medicalHistories
 */
class Info extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recipient_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'sex',
                    'birthday',
                    'citizenship',
                    'type_residence',
                    'iin',
                    'organization_id',
                    'blood_group',
                    'rh_factor',
                    'document_types',
                    'homeless',
                    'addr_reg_addr_region_id',
                    'addr_reg_addr_region_area_id',
                    'addr_reg_addr_city_id',
                    'addr_res_addr_region_id',
                    'addr_res_addr_region_area_id',
                    'addr_res_addr_city_id',
                    'user_id',
                    'created_at',
                    'updated_at',
                    'status'
                ],
                'integer'
            ],
            [
                [
                    'name',
                    'surname',
                    'patronymic',
                    'document_number',
                    'document_series',
                    'addr_reg_street_id',
                    'addr_reg_home',
                    'addr_reg_flat',
                    'addr_res_street_id',
                    'addr_res_home',
                    'addr_res_flat',
                    'work_department',
                    'work_post',
                    'work_phone'
                ],
                'string',
                'max' => 50
            ],
            [
                [
                    'document_issued',
                    'work_name'
                ],
                'string',
                'max' => 100
            ],
            [
                [
                    'document_date_issue',
                    'document_date_expiration',
                ],
                'safe'
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
            'id' => Yii::t('recipient', 'Код записи'),
            'name' => Yii::t('recipient', 'Имя'),
            'surname' => Yii::t('recipient', 'Фамилия'),
            'patronymic' => Yii::t('recipient', 'Отчество'),
            'sex' => Yii::t('recipient', 'Пол'),
            'birthday' => Yii::t('recipient', 'Дата рождения'),
            'citizenship' => Yii::t('recipient', 'Гражданство'),
            'type_residence' => Yii::t('recipient', 'Тип прописки; (Городской/Приезжий)'),
            'iin' => Yii::t('recipient', 'ИИН'),
            'organization_id' => Yii::t('recipient', '№ поликлиники прикрепления'),
            'blood_group' => Yii::t('recipient', 'Группа крови'),
            'rh_factor' => Yii::t('recipient', 'Резус фактор'),
            'document_types' => Yii::t('recipient', 'Вид удостоверяющего документа'),
            'document_number' => Yii::t('recipient', '№ уд. документа'),
            'document_series' => Yii::t('recipient', 'Серия'),
            'document_date_issue' => Yii::t('recipient', 'Дата выдачи'),
            'document_issued' => Yii::t('recipient', 'Кем выдано'),
            'document_date_expiration' => Yii::t('recipient', 'Дата окончания'),
            'homeless' => Yii::t('recipient', 'Без определенного места жительства '),
            'addr_reg_addr_region_id' => Yii::t('recipient', 'Область; Адрес прописки'),
            'addr_reg_addr_region_area_id' => Yii::t('recipient', 'Район'),
            'addr_reg_addr_city_id' => Yii::t('recipient', 'Населенный пункт/город '),
            'addr_reg_street_id' => Yii::t('recipient', 'Улица'),
            'addr_reg_home' => Yii::t('recipient', '№ дома'),
            'addr_reg_flat' => Yii::t('recipient', '№ квартиры'),
            'addr_res_addr_region_id' => Yii::t('recipient', 'Область; Адрес проживания'),
            'addr_res_addr_region_area_id' => Yii::t('recipient', 'Район'),
            'addr_res_addr_city_id' => Yii::t('recipient', 'Населенный пункт/город '),
            'addr_res_street_id' => Yii::t('recipient', 'Улица'),
            'addr_res_home' => Yii::t('recipient', '№ дома'),
            'addr_res_flat' => Yii::t('recipient', '№ квартиры'),
            'work_name' => Yii::t('recipient', 'Название; Место работы'),
            'work_department' => Yii::t('recipient', 'Отдел/Факультет'),
            'work_post' => Yii::t('recipient', 'Должность'),
            'work_phone' => Yii::t('recipient', 'Телефон'),
            'user_id' => Yii::t('recipient', 'ID пользователя'),
            'created_at' => Yii::t('recipient', 'Дата создания'),
            'updated_at' => Yii::t('recipient', 'Дата редактирования'),
            'status' => Yii::t('recipient', 'Статус'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCitizenship0()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'citizenship']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentTypes()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'document_types']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddrRegAddrCity()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'addr_reg_addr_city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddrRegAddrRegionArea()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'addr_reg_addr_region_area_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddrRegAddrRegion()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'addr_reg_addr_region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddrResAddrCity()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'addr_res_addr_city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddrResAddrRegionArea()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'addr_res_addr_region_area_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddrResAddrRegion()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'addr_res_addr_region_id']);
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
    public function getMedicalHistories()
    {
        return $this->hasMany(MH::className(), ['recipient_info_id' => 'id']);
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
            if ($this->document_date_issue) {
                $this->document_date_issue = Yii::$app->current->setDate($this->document_date_issue);
            }
            if ($this->document_date_expiration) {
                $this->document_date_expiration = Yii::$app->current->setDate($this->document_date_expiration);
            }
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
        if ($this->document_date_issue) {
            $this->document_date_issue = Yii::$app->current->getDateTime($this->document_date_issue);
        }
        if ($this->document_date_expiration) {
            $this->document_date_expiration = Yii::$app->current->getDateTime($this->document_date_expiration);
        }
        $this->created_at = Yii::$app->current->getDateTime($this->created_at);
        return parent::afterFind();
    }

    public function getGenders($k = null)
    {
        $data = [
            1 => Yii::t('recipient', 'Мужской'),
            2 => Yii::t('recipient', 'Женский'),
        ];
        return $k !== null ? $data[$k] : $data;
    }

    public function getTypesResidence($k = null)
    {
        $data = [
            1 => Yii::t('recipient', 'Городской'),
            2 => Yii::t('recipient', 'Приезжий'),
        ];
        return $k !== null ? $data[$k] : $data;
    }

}