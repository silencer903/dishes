<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use \app\rbac\UserGroupRule;

class RbacController extends Controller
{
	public function actionInit()
	{
		$authManager = \Yii::$app->authManager;
		$authManager->removeAll();
		$guest  = $authManager->createRole('guest');
		$user = $authManager->createRole('user');
		$admin  = $authManager->createRole('admin');

		$login  = $authManager->createPermission('login');
		$logout = $authManager->createPermission('logout');
		$error  = $authManager->createPermission('error');
		$index  = $authManager->createPermission('index');
		$view   = $authManager->createPermission('view');
		$update = $authManager->createPermission('update');
		$create = $authManager->createPermission('create');
		$delete = $authManager->createPermission('delete');
		$finddishesforuser = $authManager->createPermission('finddishesforuser');
		$dishes = $authManager->createPermission('dishes');
		$ingredients = $authManager->createPermission('ingredients');
		$site = $authManager->createPermission('site');

		$authManager->add($login);
		$authManager->add($logout);
		$authManager->add($error);
		$authManager->add($index);
		$authManager->add($view);
		$authManager->add($update);
		$authManager->add($create);
		$authManager->add($delete);
		$authManager->add($finddishesforuser);
		$authManager->add($dishes);
		$authManager->add($ingredients);
		$authManager->add($site);


		$userGroupRule = new UserGroupRule();
		$authManager->add($userGroupRule);

		$guest->ruleName  = $userGroupRule->name;
		$user->ruleName  = $userGroupRule->name;
		$admin->ruleName  = $userGroupRule->name;

		$authManager->add($guest);
		$authManager->add($user);
		$authManager->add($admin);

		$authManager->addChild($guest, $site);
		$authManager->addChild($guest, $login);
		$authManager->addChild($guest, $logout);
		$authManager->addChild($guest, $error);
		$authManager->addChild($guest, $view);

		$authManager->addChild($user, $index);
		$authManager->addChild($user, $finddishesforuser);
		$authManager->addChild($user, $guest);

		$authManager->addChild($admin, $delete);
		$authManager->addChild($admin, $dishes);
		$authManager->addChild($admin, $update);
		$authManager->addChild($admin, $create);
		$authManager->addChild($admin, $ingredients);
		$authManager->addChild($admin, $guest);

	}
}