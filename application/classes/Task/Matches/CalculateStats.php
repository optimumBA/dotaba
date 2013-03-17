<?php defined('SYSPATH') or die('No direct script access.');

class Task_Matches_CalculateStats extends Minion_Task {

	protected function _execute(array $params)
	{
		$type = ORM::factory('type', array('name' => 'Public matchmaking'));

		$matches = ORM::factory('match')
			->where('match.type_id', '=', $type->id)
			->where('date', '<', DB::expr('DATE_SUB(NOW(), INTERVAL 1 MONTH)'))
			->find_all();

		$directory = Kohana::$config->load('steam')->get('matches_path').DIRECTORY_SEPARATOR;

		foreach ($matches as $match)
		{
			$path = $directory.$match->id.'.json';

			if (file_exists($path))
			{
				unlink($path);
			}

			$match->delete();
		}

		$users = ORM::factory('user')
			->find_all();

		foreach ($users as $user)
		{
			$slots = $user->slots
				->with('match')
				->find_all();

			$wins   = 0;
			$losses = 0;

			foreach ($slots as $slot)
			{
				if ((int) ($slot->player_slot / 5) == $slot->match->radiant_win)
				{
					$losses++;
				}
				else
				{
					$wins++;
				}
			}

			$user->values(array(
				'wins'   => $wins,
				'losses' => $losses
			))->update();
		}
	}

}