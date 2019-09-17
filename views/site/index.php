<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <h2>Меню</h2>
            </div>
            <?php
                if(Yii::$app->user->can("dishes")){
                    echo '<div class="col-lg-12">
                <p><a class="btn btn-default" href="'.Url::to(['/dishes']).'">Блюда</a></p>
            </div>';
                }
            ?>
	        <?php
	        if(Yii::$app->user->can("ingredients")){
		        echo '<div class="col-lg-12">
                <p><a class="btn btn-default" href="'. Url::to(['/ingredients']).'">Ингридиенты</a></p>
            </div>';
	        }
	        ?>
            <div class="col-lg-12">
                <p><a class="btn btn-default" href="<?= Url::to(['/finddishesforuser'])?>">Поиск блюд по ингридиентам</a></p>
            </div>
        </div>

    </div>
</div>
