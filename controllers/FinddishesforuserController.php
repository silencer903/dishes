<?php
/**
 * Created by PhpStorm.
 * User: Lisa
 * Date: 15.09.2019
 * Time: 18:43
 */

namespace app\controllers;


use app\models\FindDishesForUser;
use Yii;

class FinddishesforuserController extends BaseController {

	public function actionIndex()
	{
		$searchModel = new FindDishesForUser();
		$dataProvider = $searchModel->findDishes(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

}