<?php defined('SYSPATH') OR die('No direct script access.');

abstract class Model extends Kohana_Model {

	public static function comments($id, $limit = NULL, $offset = NULL, $order_by = NULL)
	{
		$class = explode('_', get_called_class());

		$comments = ORM::factory('Comment')
			->with('user')
			->where('object_id', '=', $id)
			->where('object_type', '=', array_pop($class))
			->limit($limit)
			->offset($offset);

		if (is_array($order_by))
		{
			$comments->order_by($order_by[0], $order_by[1]);
		}

		$comments = $comments->find_all();

		return $comments;
	}

	public static function comments_count($id)
	{
		$class = explode('_', get_called_class());

		return ORM::factory('Comment')
			->where('object_id', '=', $id)
			->where('object_type', '=', array_pop($class))
			->count_all();
	}

}