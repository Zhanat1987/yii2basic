<?php

namespace app\modules\catalog\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\catalog\models\Personal;

/**
 * PersonalSearch represents the model behind the search form about `app\modules\catalog\models\Personal`.
 */
class PersonalSearch extends Personal
{
    public function rules()
    {
        return [
            [['department', 'organization_id'], 'integer'],
            [['surname', 'name', 'patronimic', 'post', 'department'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Personal::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'department' => $this->department,
            'organization_id' => $this->organization_id,
        ]);

        $query->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'patronimic', $this->patronimic])
            ->andFilterWhere(['like', 'post', $this->post]);

        return $dataProvider;
    }

}