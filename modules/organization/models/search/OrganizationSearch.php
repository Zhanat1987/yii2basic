<?php

namespace app\modules\organization\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\organization\models\Organization;

/**
 * OrganizationSearch represents the model behind the search form about `app\modules\organization\models\Organization`.
 */
class OrganizationSearch extends Organization
{
    public function rules()
    {
        return [
            [['id', 'region_id', 'region_area_id', 'city_id', 'street_id', 'infodonor_id', 'bin', 'created_at', 'updated_at', 'status'], 'integer'],
            [['name', 'short_name', 'home_number', 'phone', 'email', 'url', 'chief_phone', 'chief_email', 'curl'], 'safe'],
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
            'id' => $this->id,
            'region_id' => $this->region_id,
            'region_area_id' => $this->region_area_id,
            'city_id' => $this->city_id,
            'street_id' => $this->street_id,
            'infodonor_id' => $this->infodonor_id,
            'bin' => $this->bin,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'short_name', $this->short_name])
            ->andFilterWhere(['like', 'home_number', $this->home_number])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'chief_phone', $this->chief_phone])
            ->andFilterWhere(['like', 'chief_email', $this->chief_email])
            ->andFilterWhere(['like', 'curl', $this->curl]);

        return $dataProvider;
    }
}
