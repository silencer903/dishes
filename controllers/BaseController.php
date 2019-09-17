<?php
/**
 * Created by PhpStorm.
 * User: Lisa
 * Date: 17.09.2019
 * Time: 13:52
 */

namespace app\controllers;



use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class BaseController extends Controller
{
	public function init()
	{
		parent::init();
	}

	public function beforeAction($action)
	{
		if (parent::beforeAction($action)) {
			if(!Yii::$app->user->isGuest){
				$auth = Yii::$app->authManager;
				$user_role = $auth->getRole(Yii::$app->user->identity->group_type);
				if(!Yii::$app->authManager->getAssignments(Yii::$app->user->getId())){
					$auth->assign($user_role, Yii::$app->user->getId());
				}
				$access=0;
				if(Yii::$app->user->can(Yii::$app->controller->id)){
					if(Yii::$app->user->can($action->id)){
						$access=1;
					}
				}
				if($access==0){
					throw new ForbiddenHttpException('Доступ запрещён');
				}
			}elseif(Yii::$app->controller->action->id!="login"){
				return $this->redirect(['site/login']);
			}
			return true;
		} else {
			return false;
		}
	}
}