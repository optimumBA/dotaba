<?php defined('SYSPATH') OR die('No direct script access.');

abstract class Model extends Kohana_Model {

	public static function comments($id, $last_id = NULL)
	{
		$class = explode('_', get_called_class());
		$class = array_pop($class);

		$parents = ORM::factory('Comment')
			->with('user')
			->where('object_id', '=', $id)
			->where('object_type', '=', $class)
			->where('parent_id', 'IS', NULL);

		if ($last_id)
		{
			$parents->where('comment.id', '<', $last_id);
		}

		$parents = $parents
			->order_by('id', 'DESC')
			->limit(10)
			->find_all();

		$ids = array();

		foreach ($parents as $parent)
		{
			$ids[] = $parent->id;
		}

		$comments = array(
			'parents'  => $parents,
			'children' => array(),
			'more'     => 0,
			'last_id'  => (empty($ids)) ? 0 : min($ids),
		);

		if ( ! empty($ids))
		{
			$children = ORM::factory('Comment')
				->with('user')
				->where('object_id', '=', $id)
				->where('object_type', '=', $class)
				->where('parent_id', 'IN', $ids)
				->order_by('id', 'ASC')
				->find_all();

			foreach ($children as $child)
			{
				if ( ! isset($comments['children'][$child->parent_id]))
				{
					$comments['children'][$child->parent_id] = array();
				}

				$comments['children'][$child->parent_id][] = $child;
			}

			$comments['more'] = ORM::factory('Comment')
				->where('id', '<', $comments['last_id'])
				->where('object_id', '=', $id)
				->where('object_type', '=', $class)
				->where('parent_id', 'IS', NULL)
				->count_all();
		}

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