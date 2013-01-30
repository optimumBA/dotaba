<?php defined('SYSPATH') or die('No direct script access.');

class Model_Match extends Model_Database {

	public static $table_name = 'matches';

	private static $processed;

	public static function find_all_processed($limit = NULL, $offset = NULL, $order_by = NULL)
	{
		self::$processed = TRUE;
		return self::find_all($limit, $offset, $order_by);
	}

	public static function find_all_unprocessed($limit = NULL, $offset = NULL, $order_by = NULL)
	{
		self::$processed = FALSE;
		return self::find_all($limit, $offset, $order_by);
	}

	public static function find_all($limit = NULL, $offset = NULL, $order_by = NULL)
	{
		$processed = self::$processed;

		self::$processed = NULL;

		if ($processed === NULL)
		{
			return parent::find_all($limit, $offset, $order_by);
		}
		else
		{
			$operator = 'IS';

			$operator .= ($processed === TRUE) ? ' NOT' : '';

			$rows = DB::select()
				->from(self::$table_name)
				->limit($limit)
				->offset($offset)
				->where('winner_id', $operator, NULL);

			if (is_array($order_by))
			{
				$rows->order_by($order_by[0], $order_by[1]);
			}

			return $rows->as_object()
				->execute();
		}
	}

}