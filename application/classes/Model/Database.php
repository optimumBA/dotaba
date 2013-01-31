<?php defined('SYSPATH') or die('No direct script access.');

abstract class Model_Database extends Kohana_Model_Database {

	public static function find($id)
	{
		return static::find_by_attribute('id', $id);
	}

	public static function find_by_attribute($attribute, $value, $operator = '=')
	{
		return DB::select()
			->from(static::$table_name)
			->where($attribute, $operator, $value)
			->as_object()
			->execute()
			->current();
	}

	public static function find_all($limit = NULL, $offset = NULL, $order_by = NULL)
	{
		return static::find_all_by_attribute('', 1, $limit, $offset, $order_by, '');
	}

	public static function find_all_by_attribute($attribute, $value, $limit = NULL, $offset = NULL, $order_by = NULL, $operator = '=')
	{
		$rows = DB::select()
			->from(static::$table_name)
			->where($attribute, $operator, $value)
			->limit($limit)
			->offset($offset);

		if (is_array($order_by))
		{
			$rows->order_by($order_by[0], $order_by[1]);
		}

		return $rows->as_object()
			->execute();
	}

	public static function count_all()
	{
		return DB::select(DB::expr('COUNT(*) as total'))
			->from(static::$table_name)
			->execute()
			->get('total');
	}

	public static function insert(array $key_value)
	{
		return DB::insert(static::$table_name, array_keys($key_value))
			->values(array_values($key_value))
			->execute();
	}

	public static function update($value, array $key_value, $attribute = 'id', $operator = '=')
	{
		return DB::update(static::$table_name)
			->set($key_value)
			->where($attribute, $operator, $value)
			->execute();
	}

	public static function delete($value, $attribute = 'id', $operator = '=')
	{
		return DB::delete(static::$table_name)
			->where($attribute, $operator, $value)
			->execute();
	}

}