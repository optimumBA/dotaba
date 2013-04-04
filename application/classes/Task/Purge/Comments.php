<?php defined('SYSPATH') or die('No direct script access.');

class Task_Purge_Comments extends Minion_Task {

	protected function _execute(array $params)
	{
		$comments = ORM::factory('Comment')->find_all();

		foreach ($comments as $comment)
		{
			$object = ORM::factory($comment->object_type)
				->where('id', '=', $comment->object_id)
				->count_all();

			if ( ! $object)
			{
				$comment->delete();
			}
		}
	}

}