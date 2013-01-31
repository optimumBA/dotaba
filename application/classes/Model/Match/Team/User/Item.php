<?php defined('SYSPATH') or die('No direct script access.');

class Model_Match_Team_User_Item extends Model_Database {

	public static $table_name = 'matches_teams_users_items';

	public static function find_all_by_attribute($attribute, $value, $limit = NULL, $offset = NULL, $order_by = NULL, $operator = '=')
	{
		$rows = DB::select()
			->from(self::$table_name)
			->join(Model_Item::$table_name)->on(Model_Item::$table_name.'.id', '=', self::$table_name.'.item_id')
			->where($attribute, $operator, $value)
			->limit($limit)
			->offset($offset);

		if (is_array($order_by))
		{
			$rows->order_by($order_by[0], $order_by[1]);
		}

		return $rows->execute()
			->as_array();
	}

}