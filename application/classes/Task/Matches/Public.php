<?php defined('SYSPATH') or die('No direct script access.');

class Task_Matches_Public extends Minion_Task {

	protected function _execute(array $params)
	{
		$type = ORM::factory('Type', array('name' => 'Public matchmaking'));

		$users = ORM::factory('User')
			->with_last_match()
			->find_all();

		foreach ($users as $user)
		{
			$matches = Steam::match_history($user->accountid, strtotime($user->date_min));

			foreach ($matches as $match)
			{
				$result = Steam::match_results($match->match_id);

				if ($result)
				{
					Model_Match::process($result, $type, $user);
				}
			}
		}
	}

}