<?php
/**
 * Created by PhpStorm.
 * User: Lisa
 * Date: 15.09.2019
 * Time: 15:01
 */

namespace app\models;


use yii\data\ActiveDataProvider;

class FindDishesForUser extends Dishes {


	public $error_for_user="Ничего не найдено";
	public $ids_ingredients=[];

	public function rules()
	{
		return [
			[['name_dishes'], 'safe'],
			['ingredients', 'each', 'rule' => ['integer']],
		];
	}

	public function afterFind()
	{
		parent::afterFind();
		$this->ids_ingredients=array_column($this->ingredientsLink,'id_ingredients');

	}

	public function findDishes($params){
		$dataProvider = new ActiveDataProvider();

		if($params['FindDishesForUser']['ingredients']){
			$ingredients_need=$params['FindDishesForUser']['ingredients'];
			if(count($ingredients_need)<2){
				$dataProvider->setModels([]);
				$this->load($params);
				$this->error_for_user="Выберите больше ингредиентов";
			}elseif(count($ingredients_need)>5){
				$dataProvider->setModels([]);
				$this->load($params);
				$this->error_for_user="Выбрано больше 5 ингредиентов";
			}else{
				$ingredients_ids=$params['FindDishesForUser']['ingredients'];
				$query=FindDishesForUser::find()->joinWith("ingredientsLink")->where(['in','dishes_ingredients.id_ingredients',$ingredients_ids]);

				$dataProvider->query=$query;

				$this->load($params);

				$sort_array=[];
				$models=$dataProvider->getModels();
				foreach ($models as $key=>$row){
					$intersect_counts_ingredients=count(array_intersect($ingredients_need, $row['ids_ingredients']));
					if(in_array(Ingredients::HIDED_INGREDIENTS,array_column($row['ingredientsLink'], 'hided_ingredients'))!==false){
						unset($models[$key]);
					}elseif(array_search($ingredients_need, array_column($models, 'ids_ingredients'))!==false and $ingredients_need!=$row['ids_ingredients']){
						unset($models[$key]);
					}elseif($intersect_counts_ingredients>1){
						$sort_array[$key]=$intersect_counts_ingredients;
					}elseif($intersect_counts_ingredients<=1){
						unset($models[$key]);
					}
				}
				if($sort_array){
					array_multisort($sort_array,SORT_DESC,$models);
				}
				$dataProvider->setModels($models);
			}
		}else{
			$dataProvider->setModels([]);
			$this->load($params);
			$this->error_for_user="Выберите больше ингредиентов";
		}


		return $dataProvider;
	}
}