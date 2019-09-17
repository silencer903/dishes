<?php
namespace app\rbac;

use Yii;
use yii\rbac\Rule;

class UserGroupRule extends Rule
{
	public $name = 'userGroup';

	public function execute($user, $item, $params)
	{
		Yii::info($user);
		Yii::info($item);
		Yii::info($params);
		if (!Yii::$app->user->isGuest) {
			$group = Yii::$app->user->identity->group_type;
			if ($item->name === 'admin') {
				return $group == 'admin';
			} elseif ($item->name === 'user') {
				return $item->name === 'user';
			}
		}
		return true;
	}
}
