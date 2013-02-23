<?php defined('SYSPATH') or die('No direct script access.');

class Task_Matches_Cache extends Minion_Task {

	protected function _execute(array $params)
	{
		$matches = ORM::factory('match')
			->where('created_at', '<', DB::expr('DATE_SUB(NOW(), INTERVAL 1 MONTH)'))
			->find_all();

		foreach ($matches as $match)
		{
			Steam::match_results($match->mid, FALSE);
		}
	}

}