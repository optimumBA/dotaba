<?php defined('SYSPATH') or die('No direct script access.');

class Task_Heroes_Get extends Minion_Task {

	protected function _execute(array $params)
	{
		$heroes = Steam::heroes();

		foreach ($heroes as $hero)
		{
			if (Model_Hero::find($hero->id) === FALSE)
			{
				Model_Hero::insert(array(
					'id'             => $hero->id,
					'name'           => $hero->name,
					'localized_name' => $hero->localized_name,
				));
			}
		}
	}

}