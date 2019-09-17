<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Dishes */
$this->title="Блюда";
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name_dishes;
\yii\web\YiiAsset::register($this);
?>
<div class="dishes-view">
    <h1><?= Html::encode($model->name_dishes) ?></h1>

    <p>
        <?= Html::a('Редактирование', ['update', 'id' => $model->id_dishes], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id_dishes], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Действительно хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_dishes',
            'name_dishes',
        ],
    ]) ?>

</div>
