<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "dishes".
 *
 * @property int $id_dishes
 * @property string $name_dishes
 * @property int $deleted_dishes
 *
 * @property Ingredients[] $ingredients
 */
class Dishes extends \yii\db\ActiveRecord
{

	const DELETED_DISHES=1;
	const NOT_DELETED_DISHES=0;

	public $ingredients=[];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dishes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_dishes'], 'required','message'=>'{attribute} не должно быть пустым'],
            [['name_dishes'], 'string', 'max' => 50],
            [['id_dishes'], 'exist', 'skipOnError' => true, 'targetClass' => Dishes::className(), 'targetAttribute' => ['id_dishes' => 'id_dishes'],],
	        ['ingredients', 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_dishes' => 'id',
            'name_dishes' => 'Название блюда',
        ];
    }

    public static function getDish($id){
    	$result = Dishes::find()->with("ingredientsLink")->where(['dishes.id_dishes'=>$id])->limit(1)->one();
	    $result->ingredients=array_column(ArrayHelper::toArray($result->ingredientsLink),"id_ingredients");
    	return $result;
    }


    public function getIngredientsLink(){
	    return $this->hasMany(Ingredients::className(), ['id_ingredients' => 'id_ingredients'])
	                ->viaTable('dishes_ingredients', ['id_dishes' => 'id_dishes']);
    }

    public function getIngredientsOfDishArray(){
    	return $this->getIngredientsLink()->asArray(1)->all();
    }

    public function saveDishWithIngredients(){
    	if($this->validate()){
		    $this->save();
		    if(is_array($this->ingredients) and !empty($this->ingredients)){
			    $transaction = Ingredients::getDb()->beginTransaction();
			    try {
				    $dishes_ingredients=new DishesIngredients();
				    $dishes_ingredients->deleteAll(['id_dishes'=>$this->id_dishes]);
				    Yii::info($this->ingredients);
				    $insert_array=array_map(function ($row){
					    return [$this->id_dishes,$row];
				    },$this->ingredients);
				    Yii::info($insert_array);
				    Dishes::getDb()->createCommand()->batchInsert('dishes_ingredients', ['id_dishes', 'id_ingredients'], $insert_array)->execute();
				    $transaction->commit();
			    } catch(\Exception $e) {
				    $transaction->rollBack();
				    throw $e;
			    } catch(\Throwable $e) {
				    $transaction->rollBack();
				    throw $e;
			    }
		    }
	    }

    }

    public function deleteDish(){
    	$this->validate();
		$this->deleted_dishes=self::DELETED_DISHES;
		$this->save();
		return true;
    }

}
