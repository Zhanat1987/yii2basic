<?php

namespace app\modules\rbac\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rbac\models\AuthItem;

/**
 * AuthItemSearch represents the model behind the search form about `app\modules\rbac\models\AuthItem`.
 */
class AuthItemSearch extends AuthItem
{

    public function rules()
    {
        return [
            [['name', 'description', 'rule_name', 'data'], 'safe'],
//            [['type', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'rule_name', 'data', 'created_at'], 'safe'],
            [['type', 'updated_at'], 'integer'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = AuthItem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'type' => $this->type,
//            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        if ($this->created_at) {
            list($month, $day, $year) = explode('/', $this->created_at);
            $startDate = mktime(0, 0, 0, $month, $day, $year);
            $endDate = $startDate + 86400;
            $query->andFilterWhere([
                'between', 'created_at', $startDate, $endDate
            ]);
        }
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'rule_name', $this->rule_name])
            ->andFilterWhere(['like', 'data', $this->data]);

        return $dataProvider;
    }
}
