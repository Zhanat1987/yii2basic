<?php

namespace app\modules\recipient\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\recipient\models\Info;

/**
 * InfoSearch represents the model behind the search form about `app\modules\recipient\models\Info`.
 */
class InfoSearch extends Info
{

    public $mhNumber,
           $dateReceipt,
           $dateDischarge,
           $treatmentOutcome,
           $conveyPlaceResidence;

    public function rules()
    {
        return [
            [
                [
                    'id',
                    'birthday',
                    'created_at',
                    'status',
                    'addr_reg_addr_region_id',
                    'addr_reg_addr_city_id',
                    'addr_reg_street_id',
                ],
                'integer'
            ],
            [
                [
                    'name',
                    'surname',
                    'patronymic',
                    'addr_reg_home',
                    'addr_reg_flat',
                    'mhNumber',
                    'dateReceipt',
                    'dateDischarge',
                    'treatmentOutcome',
                    'conveyPlaceResidence',
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
        $query = Info::find()
            ->joinWith(['mh'], true);

        $query->andFilterWhere(['recipient_info.status' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->created_at) {
            $interval = Yii::$app->current->getDateInterval($this->created_at);
            $query->andFilterWhere([
                'between', 'recipient_info.created_at', $interval[0], $interval[1]
            ]);
        }

        if ($this->birthday) {
            $interval = Yii::$app->current->getDateInterval($this->birthday);
            $query->andFilterWhere([
                'between', 'recipient_info.birthday', $interval[0], $interval[1]
            ]);
        }

        if ($this->dateReceipt) {
            $interval = Yii::$app->current->getDateInterval($this->dateReceipt);
            $query->andFilterWhere([
                'between', 'recipient_medical_history.date_receipt', $interval[0], $interval[1]
            ]);
        }

        if ($this->dateDischarge) {
            $interval = Yii::$app->current->getDateInterval($this->dateDischarge);
            $query->andFilterWhere([
                'between', 'recipient_medical_history.date_discharge', $interval[0], $interval[1]
            ]);
        }

        $query->andFilterWhere([
            'recipient_info.id' => $this->id,
            'recipient_info.addr_reg_addr_region_id' => $this->addr_reg_addr_region_id,
            'recipient_info.addr_reg_addr_city_id' => $this->addr_reg_addr_city_id,
            'recipient_info.addr_reg_street_id' => $this->addr_reg_street_id,
            'recipient_medical_history.treatment_outcome' => $this->treatmentOutcome,
            'recipient_medical_history.convey_place_residence' => $this->conveyPlaceResidence,
        ]);

        $query->andFilterWhere(['like', 'recipient_info.name', $this->name])
            ->andFilterWhere(['like', 'recipient_info.surname', $this->surname])
            ->andFilterWhere(['like', 'recipient_info.patronymic', $this->patronymic])
            ->andFilterWhere(['like', 'recipient_info.addr_reg_home', $this->addr_reg_home])
            ->andFilterWhere(['like', 'recipient_info.addr_reg_flat', $this->addr_reg_flat]);

        if ($this->mhNumber) {
            $query->andFilterWhere(['like', 'recipient_medical_history.number', $this->mhNumber]);
        }

        return $dataProvider;
    }
}
