<?php

namespace app\modules\rbac\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\rbac\models\AuthAssignment;

/**
 * AuthAssignmentSearch represents the model behind the search form about
 * `app\modules\rbac\models\AuthAssignment`.
 */
class AuthAssignmentSearch extends AuthAssignment
{

    public function rules()
    {
        return [
            [['item_name', 'user_id', 'created_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = AuthAssignment::find()->with('user');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'item_name' => $this->item_name,
            'user_id'   => $this->user_id,
        ]);

        if ($this->created_at) {
            $interval = Yii::$app->current->getDateInterval($this->created_at);
            $query->andFilterWhere([
                'between', 'created_at', $interval[0], $interval[1]
            ]);
        }

        return $dataProvider;
    }

}