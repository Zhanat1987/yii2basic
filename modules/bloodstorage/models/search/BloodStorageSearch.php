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
    
    public function rules()
    {
        return [
            [
                [
                    'id',
                    'waybill_body_id',
                    'type_send',
                    'date_send',
                    'department',
                    'defect',
                    'organization_id',
                    'recipient_medical_history_id',
                    'document_number',
                    'document_date_print',
                    'partial_transfusion',
                    'volume_transfused',
                    'quantity',
                    'type',
                    'keytime',
                    'epicrisis',
                    'id_cdlc_delete',
                    'single_wb',
                    'is_original',
                    'created_at',
                    'updated_at',
                    'status'
                ],
                'integer'
            ],
            [
                [
                    'ids',
                    'recipientkey'
                ],
                'safe'
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
        $query = BloodStorage::find();

        $query->andFilterWhere(['status' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'waybill_body_id' => $this->waybill_body_id,
            'type_send' => $this->type_send,
            'date_send' => $this->date_send,
            'department' => $this->department,
            'defect' => $this->defect,
            'organization_id' => $this->organization_id,
            'recipient_medical_history_id' => $this->recipient_medical_history_id,
            'document_number' => $this->document_number,
            'document_date_print' => $this->document_date_print,
            'partial_transfusion' => $this->partial_transfusion,
            'volume_transfused' => $this->volume_transfused,
            'quantity' => $this->quantity,
            'type' => $this->type,
            'keytime' => $this->keytime,
            'epicrisis' => $this->epicrisis,
            'id_cdlc_delete' => $this->id_cdlc_delete,
            'single_wb' => $this->single_wb,
            'is_original' => $this->is_original,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'ids', $this->ids])
            ->andFilterWhere(['like', 'recipientkey', $this->recipientkey]);

        return $dataProvider;
    }
}
