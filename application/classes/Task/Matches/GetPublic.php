<?php defined('SYSPATH') or die('No direct script access.');

class Task_Matches_Get extends Minion_Task {

	protected function _execute(array $params)
	{
		$type = ORM::factory('type', array('name' => 'Public matchmaking'));

		$users = ORM::factory('user')->find_all();

		foreach ($users as $user)
		{
			$last_match = ORM::factory('match')
				->join('slots')
				->on('slots.match_id', '=', 'match.id')
				->where('slots.user_id', '=', $user->id)
				->where('match.type_id', '=', $type->id)
				->order_by('date', 'DESC')
				->find();

			$date = ($last_match != FALSE) ? strtotime($last_match->date) : NULL;

			$matches = Steam::match_history($user->account_id, $date);

			foreach ($matches as $m)
			{
				$match = ORM::factory('match', array('mid' => $m->match_id));

				if ($m->lobby_type == $type->lobby_type AND ! $match->loaded())
				{
					$match->values(array(
						'mid' => $m->match_id,
						'type_id' => $type->id
					))->create();
				}
			}
		}
	}

}