<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dishes_ingredients".
 *
 * @property int $id_dishes
 * @property int $id_ingredients
 *
 * @property Dishes $dishes
 * @property Ingredients $ingredients
 */
class DishesIngredients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dishes_ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_dishes', 'id_ingredients'], 'required'],
            [['id_dishes', 'id_ingredients'], 'integer'],
            [['id_dishes', 'id_ingredients'], 'unique', 'targetAttribute' => ['id_dishes', 'id_ingredients']],
            [['id_dishes'], 'exist', 'skipOnError' => true, 'targetClass' => Dishes::className(), 'targetAttribute' => ['id_dishes' => 'id_dishes']],
            [['id_ingredients'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredients::className(), 'targetAttribute' => ['id_ingredients' => 'id_ingredients']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_dishes' => 'id',
            'id_ingredients' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDishes()
    {
        return $this->hasOne(Dishes::className(), ['id_dishes' => 'id_dishes']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasOne(Ingredients::className(), ['id_ingredients' => 'id_ingredients']);
    }


}
