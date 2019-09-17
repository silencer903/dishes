<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FindDishesForUser */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Поиск блюд";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="find-dishes-for-user-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<?php Pjax::begin(['enablePushState' => false]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'emptyText' => $searchModel->error_for_user,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			[
			    'attribute'=>'name_dishes',

            ],
			[
			    'attribute'=>'ingredients',
				'filter'=>Html::activeCheckboxList($searchModel,"ingredients",\app\models\Ingredients::getIngredientsArray()),
				'label'=>"Ингредиенты",
				'value' => function($model) {
					return implode(',',array_column($model->getIngredientsOfDishArray(),'name_ingredients') );
				},

			],

		],
	]); ?>
	<?php Pjax::end(); ?>



</div>
