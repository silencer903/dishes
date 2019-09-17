<?php

namespace app\models;

use Codeception\Module\Yii1;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dishes;

/**
 * DishesSearch represents the model behind the search form of `app\models\Dishes`.
 */
class DishesSearch extends Dishes
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_dishes'], 'integer'],
            [['name_dishes'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Dishes::find();

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_dishes' => $this->id_dishes,
        ]);

        $query->andFilterWhere(['like', 'name_dishes', $this->name_dishes]);

	    $query->andFilterWhere([
		    'deleted_dishes' => Dishes::NOT_DELETED_DISHES,
	    ]);

        return $dataProvider;
    }
}
