<?php defined('SYSPATH') or die('No direct script access.');

class Task_Items_CacheImages extends Minion_Task {

	protected function _execute(array $params)
	{
		$items = ORM::factory('item')->find_all();

		foreach ($items as $item)
		{
			Media_Item::cache($item->id, $item->image);
		}
	}

}