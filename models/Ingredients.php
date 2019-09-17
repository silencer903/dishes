<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ingredients".
 *
 * @property int $id_ingredients
 * @property string $name_ingredients
 * @property int $hided_ingredients
 * @property int $deleted_ingredients
 * @property DishesIngridients[] $dishesIngridients
 * @property Dishes[] $dishes
 * @property DishesIngridients $ingredients
 */
class Ingredients extends \yii\db\ActiveRecord
{
	const DELETED_INGREDIENTS=1;
	const NOT_DELETED_INGREDIENTS=0;
	const HIDED_INGREDIENTS=1;
	const NOT_HIDED_INGREDIENTS=0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_ingredients','hided_ingredients'], 'required','message'=>'{attribute} не должно быть пустым'],
            [['name_ingredients'], 'string', 'max' => 50],
            [['id_ingredients'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredients::className(), 'targetAttribute' => ['id_ingredients' => 'id_ingredients']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ingredients' => 'id',
            'name_ingredients' => 'Имя ингридиента',
            'hided_ingredients' => 'Скрыть ингридиент',
        ];
    }

	public static function getIngredients(){
		return Ingredients::find()->andWhere(["deleted_ingredients"=>0])->all();

	}

	public static function getIngredientsArray(){
		return ArrayHelper::map(Ingredients::getIngredients(), 'id_ingredients', 'name_ingredients');

	}

	public function deleteIngredient(){
    	$this->validate();
    	$this->deleted_ingredients=self::DELETED_INGREDIENTS;
    	$this->save();
    	return true;
	}

}
