<?php defined('SYSPATH') or die('No direct script access.');

class Task_Matches_Process extends Minion_Task {

	protected function _execute(array $params)
	{
		$matches = ORM::factory('Match')
			->where('mid', 'IS NOT', NULL)
			->where('processed', '=', FALSE)
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