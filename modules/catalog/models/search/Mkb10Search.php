<?php

namespace app\modules\catalog\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\catalog\models\Mkb10;

/**
 * Mkb10Search represents the model behind the search form about
 * `app\modules\catalog\models\Mkb10`.
 */
class Mkb10Search extends Mkb10
{
    public function rules()
    {
        return [
            [['icd10', 'diagnosis', 'status'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Mkb10::find();

        $query->andFilterWhere(['status' => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'icd10', $this->icd10])
            ->andFilterWhere(['like', 'diagnosis', $this->diagnosis]);

        return $dataProvider;
    }

}