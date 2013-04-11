<?php defined('SYSPATH') or die('No direct script access.');

class Task_Users_Friendships extends Minion_Task {

	protected function _execute(array $params)
	{
		$users = ORM::factory('User')->find_all();

		foreach ($users as $user)
		{
			$friends = Steam::friends_list($user->steamid);

			$ids = array();

			foreach ($friends as $friend)
			{
				$u = ORM::factory('user', array('steamid' => $friend->steamid));

				if ($u->loaded())
				{
					$ids[] = $u->id;

					$friendship = ORM::factory('Friendship')
						->where('user_id', '=', $user->id)
						->where('friend_id', '=', $u->id)
						->count_all();

					if ( ! $friendship)
					{
						ORM::factory('Friendship')->values(array(
							'user_id'   => $user->id,
							'friend_id' => $u->id,
						))->create();
					}
				}
			}

			Model_Friendship::forget_old($user->id, $ids);
		}
	}

}