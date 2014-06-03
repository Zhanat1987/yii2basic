<?php

namespace app\modules\request\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\request\models\Header;

/**
 * HeaderSearch represents the model behind the search form about
 * `app\modules\request\models\Header`.
 */
class HeaderSearch extends Header
{

    public function rules()
    {
        return [
            [
                [
                    'id',
                    'request_date',
                    'personal',
                    'receiver',
                    'request_status',
                    'was_read',
                    'organization_id',
                    'status',
                ],
                'integer'
            ],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Header::find();

        $query->andFilterWhere(['status' => 1]);

        if (Yii::$app->getRequest()->getCookies()->getValue('role') == 'Стационар') {
            $query->andFilterWhere(['organization_id' => Yii::$app->getRequest()->getCookies()->getValue('organizationId')]);
        } else if (Yii::$app->getRequest()->getCookies()->getValue('role') == 'Центр крови') {
            $query->andFilterWhere(['receiver' => Yii::$app->getRequest()->getCookies()->getValue('organizationId')]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->request_date) {
            $interval = Yii::$app->current->getDateInterval($this->request_date);
            $query->andFilterWhere([
                'between', 'request_date', $interval[0], $interval[1]
            ]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'personal' => $this->personal,
            'receiver' => $this->receiver,
            'request_status' => $this->request_status,
            'was_read' => $this->was_read,
        ]);

        return $dataProvider;
    }

}