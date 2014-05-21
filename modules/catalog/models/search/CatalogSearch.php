<?php

namespace app\modules\catalog\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\catalog\models\Catalog;

/**
 * CatalogSearch represents the model behind the search form about `app\modules\catalog\models\Catalog`.
 */
class CatalogSearch extends Catalog
{

    public $organization, $types, $nameM;

    public function rules()
    {
        return [
            [['organization_id', 'type'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Catalog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->where(['type' => $this->types]);
        if ($this->nameM) {
            $query->andFilterWhere(['like', 'name', $this->nameM]);
        }

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'organization_id' => $this->organization_id,
            'type'            => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->orderBy(['id' => SORT_ASC]);
        if ($this->organization) {
            $query->groupBy('organization_id, type');
        } else {
            $query->groupBy('type');
        }
        Yii::$app->debugger->debug($this->name);

        return $dataProvider;
    }

}