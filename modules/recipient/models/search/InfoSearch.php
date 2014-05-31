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
    public function rules()
    {
        return [
            [['id', 'birthday', 'created_at', 'status'], 'integer'],
            [['name', 'surname', 'patronymic'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Info::find();

        $query->andFilterWhere(['status' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->created_at) {
            $interval = Yii::$app->current->getDateInterval($this->created_at);
            $query->andFilterWhere([
                'between', 'created_at', $interval[0], $interval[1]
            ]);
        }

        if ($this->birthday) {
            $interval = Yii::$app->current->getDateInterval($this->birthday);
            $query->andFilterWhere([
                'between', 'birthday', $interval[0], $interval[1]
            ]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'patronymic', $this->patronymic]);

        return $dataProvider;
    }
}
