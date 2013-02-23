<?php defined('SYSPATH') or die('No direct script access.');

class Task_Matches_Update extends Minion_Task {

	protected function _execute(array $params)
	{
		$matches = ORM::factory('match')
			->where('updated_at', '<', DB::expr('DATE_SUB(NOW(), INTERVAL 7 DAY)'))
			->find_all();

		foreach ($matches as $match)
		{
			$result = Steam::match_results($match->mid);

			if ($result === FALSE)
				continue;

			Model_Match::process($match->id, $result);
		}
	}

}