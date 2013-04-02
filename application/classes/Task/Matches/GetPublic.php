<?php defined('SYSPATH') or die('No direct script access.');

class Task_Matches_Getpublic extends Minion_Task {

	protected function _execute(array $params)
	{
		$type = ORM::factory('Type', array('name' => 'Public matchmaking'));

		$matches = ORM::factory('Match')
			->where('match.type_id', '=', $type->id)
			->where('date', '<', DB::expr('DATE_SUB(NOW(), INTERVAL 1 MONTH)'))
			->find_all();

		$directory = Kohana::$config->load('steam')->get('matches_path').DIRECTORY_SEPARATOR;

		foreach ($matches as $match)
		{
			$slots = $match->slots
				->with('user')
				->find_all();

			foreach ($slots as $slot)
			{
				if ($slot->leaver_status == 3)
				{
					$slot->user->values(array('abandons' => DB::expr('abandons - 1')));
				}
				elseif ((int) ($slot->player_slot / 5) == $match->radiant_win)
				{
					$slot->user->values(array('losses' => DB::expr('losses - 1')));
				}
				else
				{
					$slot->user->values(array('wins' => DB::expr('wins - 1')));
				}

				$slot->user->update();
			}

			$path = $directory.$match->id.'.json';

			if (file_exists($path))
			{
				unlink($path);
			}

			$match->delete();
		}

		$users = ORM::factory('User')->find_all();

		foreach ($users as $user)
		{
			$last_match = ORM::factory('Match')
				->join('slots')
				->on('slots.match_id', '=', 'match.id')
				->where('slots.user_id', '=', $user->id)
				->where('match.type_id', '=', $type->id)
				->order_by('date', 'DESC')
				->find();

			$last_match_date = ($last_match != FALSE) ? strtotime($last_match->date) : 0;
			$last_month      = strtotime('-1 month');
			$date            = ($last_month > $last_match_date) ? $last_month : $last_match_date;

			$matches = Steam::match_history($user->accountid, $date);

			foreach ($matches as $m)
			{
				$result = Steam::match_results($m->match_id);

				if ($result)
				{
					Model_Match::process($m->match_id, $result, $type);
				}
			}
		}
	}

}