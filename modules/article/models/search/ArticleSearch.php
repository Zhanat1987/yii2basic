<?php

namespace app\modules\article\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\article\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `app\modules\article\models\Article`.
 */
class ArticleSearch extends Article
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'text'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Article::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
