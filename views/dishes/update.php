<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dishes */
$this->title="Блюда";
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_dishes, 'url' => ['view', 'id' => $model->id_dishes]];
$this->params['breadcrumbs'][] = 'Редактирование блюда: ' . $model->name_dishes;
?>
<div class="dishes-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
