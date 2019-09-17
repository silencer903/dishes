<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IngredientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ингридиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredients-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать ингредиент', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_ingredients',
            'name_ingredients',
            [
	            'attribute' => 'hided_ingredients',
	            'filter' => Html::activeDropDownList($searchModel, 'hided_ingredients', [$searchModel::NOT_HIDED_INGREDIENTS=>"Не скрыт",$searchModel::HIDED_INGREDIENTS=>"Скрыт"],['class'=>'form-control','prompt' => 'Выберите статус',]),
	            'value'=>function ($model, $key, $index, $column) {
		            return $model{$column->attribute} ? "Скрыт" : "Не скрыт" ;
	            },

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
