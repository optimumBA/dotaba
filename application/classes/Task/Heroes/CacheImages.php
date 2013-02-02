<?php defined('SYSPATH') or die('No direct script access.');

class Task_Heroes_CacheImages extends Minion_Task {

	protected function _execute(array $params)
	{
		$heroes = Model_Hero::find_all_by_attribute('status', 1);

		foreach ($heroes as $hero)
		{
			Media_Hero::cache($hero->id, $hero->image);
		}
	}

}