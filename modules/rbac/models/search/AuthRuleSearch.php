<?php

namespace app\modules\rbac\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rbac\models\AuthRule;
use app\myhelpers\Current;

/**
 * AuthRuleSearch represents the model behind the search form about `app\modules\rbac\models\AuthRule`.
 */
class AuthRuleSearch extends AuthRule
{
    public function rules()
    {
        return [
            [['name', 'data', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = AuthRule::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->created_at) {
            $interval = Current::getDateInterval($this->created_at);
            $query->andFilterWhere([
                'between', 'created_at', $interval[0], $interval[1]
            ]);
        }

        if ($this->updated_at) {
            $interval = Current::getDateInterval($this->updated_at);
            $query->andFilterWhere([
                'between', 'updated_at', $interval[0], $interval[1]
            ]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'data', $this->data]);

        return $dataProvider;
    }
}
