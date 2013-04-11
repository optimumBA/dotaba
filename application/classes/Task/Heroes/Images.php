<?php defined('SYSPATH') or die('No direct script access.');

class Task_Heroes_Images extends Minion_Task {

	protected function _execute(array $params)
	{
		$heroes = ORM::factory('Hero')
			->where('status', '=', FALSE)
			->find_all();

		foreach ($heroes as $hero)
		{
			Media_Remote_Hero::cache($hero->id, $hero->image);
		}
	}

}