<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ingredients */

$this->title = "Ингредиенты";
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_ingredients, 'url' => ['view', 'id' => $model->id_ingredients]];
$this->params['breadcrumbs'][] = 'Редактирование ингредиента: ' . $model->name_ingredients;;
?>
<div class="ingredients-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
