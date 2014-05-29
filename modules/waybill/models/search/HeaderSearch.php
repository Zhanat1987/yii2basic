<?php

namespace app\modules\waybill\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\waybill\models\Header;

/**
 * HeaderSearch represents the model behind the search form about
 * `app\modules\waybill\models\Header`.
 */
class HeaderSearch extends Header
{

    public function rules()
    {
        return [
            [['id', 'date', 'request', 'organization_id', 'status'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Header::find();

        $query->andFilterWhere(['status' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->date) {
            $interval = Yii::$app->current->getDateInterval($this->date);
            $query->andFilterWhere([
                'between', 'date', $interval[0], $interval[1]
            ]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'request' => $this->request,
            'organization_id' => $this->organization_id,
        ]);

        return $dataProvider;
    }

}