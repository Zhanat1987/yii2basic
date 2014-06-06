<?php

namespace app\modules\bloodstorage\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\bloodstorage\models\BloodStorage;

/**
 * BloodStorageSearch represents the model behind the search form about
 * `app\modules\bloodstorage\models\BloodStorage`.
 */
class BloodStorageSearch extends BloodStorage
{

    public $bloodGroup,
           $rhFactor,
           $compPrep,
           $volume,
           $regNumber,
           $series,
           $datePrepare,
           $dateExpiration,
           $donor,
           $number,
           $fio;

    public function rules()
    {
        return [
            [
                [
//                    'waybill_body_id',
//                    'defect',
//                    'organization_id',
//                    'recipient_medical_history_id',
//                    'document_number',
//                    'document_date_print',
//                    'partial_transfusion',
//                    'volume_transfused',
//                    'type',
//                    'keytime',
//                    'epicrisis',
//                    'id_cdlc_delete',
//                    'single_wb',
//                    'is_original',
                    'id',
                    'type_send',
                    'bloodGroup',
                    'rhFactor',
                    'compPrep',
                    'volume',
                    'regNumber',
                    'department',
                    'quantity',
                ],
                'integer'
            ],
            [
                [
                    'donor',
                    'date_send',
                    'datePrepare',
                    'dateExpiration',
                    'created_at',
                    'series',
                    'number',
                    'fio',
                ],
                'safe'
            ],
            [
                [
                    'donor',
                    'date_send',
                    'datePrepare',
                    'dateExpiration',
                    'created_at',
                    'series',
                    'number',
                    'fio',
                ],
                'filter',
                'filter' => 'trim'
            ],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
//        $query = BloodStorage::find()->with('body', 'mh');
        $query = BloodStorage::find()
            ->innerJoinWith(['body'], true)
            ->leftJoin(['recipient_medical_history'],
                'blood_storage.recipient_medical_history_id = recipient_medical_history.id')
            ->leftJoin(['waybill_header'], 'waybill_body.waybill_header_id = waybill_header.id')
            ->leftJoin(['recipient_info'],
                'recipient_medical_history.recipient_info_id = recipient_info.id');

        $query->where('blood_storage.quantity > 0');

        $query->andFilterWhere(['blood_storage.status' => 1]);

        $query->andFilterWhere([
            'blood_storage.type' => $this->type,
        ]);

        if (Yii::$app->getRequest()->getCookies()->getValue('role') == 'Стационар') {
            $query->andFilterWhere(['waybill_header.organization_id' =>
                                        Yii::$app->getRequest()->getCookies()->getValue('organizationId')]);
        } else if (Yii::$app->getRequest()->getCookies()->getValue('role') == 'Центр крови') {
            $query->andFilterWhere(['waybill_header.sender' =>
                                        Yii::$app->getRequest()->getCookies()->getValue('organizationId')]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
//            'sort' => [
//                // Set the default sort by name ASC and created_at DESC.
//                'defaultOrder' => [
//                    'created_at' => SORT_DESC
//                ],
//                'attributes' => [
//                    'id',
//                    'created_at',
//                    'donor',
//                    'series',
//                    'number',
//                    'date_send',
//                    'type_send',
////                    'bloodGroup',
////                    'rhFactor',
////                    'compPrep',
//                    'volume',
////                    'regNumber',
//                    'department',
//                    'quantity',
//                ],
//            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->created_at) {
            $interval = Yii::$app->current->getDateInterval($this->created_at);
            $query->andFilterWhere([
                'between', 'blood_storage.created_at', $interval[0], $interval[1]
            ]);
        }

        if ($this->datePrepare) {
            $interval = Yii::$app->current->getDateInterval($this->datePrepare);
            $query->andFilterWhere([
                'between', 'waybill_body.date_prepare', $interval[0], $interval[1]
            ]);
        }

        if ($this->dateExpiration) {
            $interval = Yii::$app->current->getDateInterval($this->dateExpiration);
            $query->andFilterWhere([
                'between', 'waybill_body.date_expiration', $interval[0], $interval[1]
            ]);
        }

        if ($this->date_send) {
            $interval = Yii::$app->current->getDateInterval($this->date_send);
            $query->andFilterWhere([
                'between', 'blood_storage.date_send', $interval[0], $interval[1]
            ]);
        }

        $query->andFilterWhere([
            'blood_storage.id' => $this->id,
            'waybill_body.blood_group' => $this->bloodGroup,
            'waybill_body.rh_factor' => $this->rhFactor,
            'waybill_body.comp_prep_id' => $this->compPrep,
            'waybill_body.volume' => $this->volume,
            'waybill_body.registration_number' => $this->regNumber,
            'waybill_body.series' => $this->series,
            'blood_storage.type_send' => $this->type_send,
            'blood_storage.department' => $this->department,
            'waybill_body.donor' => $this->donor,
            'recipient_medical_history_id.number' => $this->number,
//            'defect' => $this->defect,
//            'organization_id' => $this->organization_id,
//            'recipient_medical_history_id' => $this->recipient_medical_history_id,
//            'document_number' => $this->document_number,
//            'document_date_print' => $this->document_date_print,
//            'partial_transfusion' => $this->partial_transfusion,
//            'volume_transfused' => $this->volume_transfused,
//            'quantity' => $this->quantity,
//            'keytime' => $this->keytime,
//            'epicrisis' => $this->epicrisis,
//            'id_cdlc_delete' => $this->id_cdlc_delete,
//            'single_wb' => $this->single_wb,
//            'is_original' => $this->is_original,
        ]);

//        $query->andFilterWhere(['like', 'ids', $this->ids])
//            ->andFilterWhere(['like', 'recipientkey', $this->recipientkey]);

        if ($this->fio) {
            $query->andFilterWhere(['or', ['like', 'recipient_info.surname', '1'],
                ['like', 'recipient_info.name', '2'], ['like', 'recipient_info.patronymic', '3']]);
        }

        return $dataProvider;
    }

}