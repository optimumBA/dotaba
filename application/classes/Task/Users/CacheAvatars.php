<?php defined('SYSPATH') or die('No direct script access.');

class Task_Users_CacheAvatars extends Minion_Task {

	protected function _execute(array $params)
	{
		$count = ORM::factory('user')->count_all();

		$offset = 0;
		$limit  = 100;

		do {
			$users = ORM::factory('user')->limit($limit)->offset($offset)->find_all();

			foreach ($users as $user)
			{
				Steam::cache_avatar($user->id, $user->avatar);
			}

			$offset += $limit;
		} while ($offset < $count);
	}

}