<?php

namespace app\modules\organization\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\organization\models\Organization;

/**
 * OrganizationSearch represents the model behind the search form about
 * `app\modules\organization\models\Organization`.
 */
class OrganizationSearch extends Organization
{

    public function rules()
    {
        return [
            [['region_id', 'region_area_id', 'city_id'], 'integer'],
            [['name', 'short_name', 'role'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Organization::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'role'           => $this->role,
            'region_id'      => $this->region_id,
            'region_area_id' => $this->region_area_id,
            'city_id'        => $this->city_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'short_name', $this->short_name]);

        return $dataProvider;
    }
}
