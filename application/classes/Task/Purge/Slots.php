<?php defined('SYSPATH') or die('No direct script access.');

class Task_Purge_Slots extends Minion_Task {

	protected function _execute(array $params)
	{
		$slots = ORM::factory('Slot')
			->with('match')
			->find_all();

		foreach ($slots as $slot)
		{
			if ( ! $slot->match->loaded())
			{
				$slot->delete();
			}
		}
	}

}