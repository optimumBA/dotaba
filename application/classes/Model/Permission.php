<?php defined('SYSPATH') or die('No direct script access.');

class Model_Permission extends Model_Database {

	private static $actions = array('create', 'read', 'update', 'delete');

	public static function check($aro, $aco, $action = '*')
	{
		if ( ! $aro || ! $aco)
		{
			return FALSE;
		}

		if ($action !== '*' AND ! in_array($action, self::$actions))
		{
			return FALSE;
		}

		$aro_path = Model_Aro::path($aro);
		$aco_path = Model_Aco::path($aco);

		$acos = array();

		foreach ($aco_path as $aco)
		{
			$acos[] = $aco['id'];
		}

		foreach ($aro_path as $aro)
		{
			$perms = DB::select()
				->from('acos_aros')
				->join('acos')
				->on('acos.id', '=', 'acos_aros.aco_id')
				->where('aco_id', 'IN', $acos)
				->where('aro_id', '=', $aro['id'])
				->order_by('acos.lft')
				->execute()
				->as_array();

			if (empty($perms))
				continue;

			$i = 0;

			foreach ($perms as $perm)
			{
				if ($action === '*')
				{
					$inherited = array();

					foreach (self::$actions as $key)
					{
						if ( ! empty($perm))
						{
							if ($perm['_'.$key] == -1)
							{
								return '-1';
							}
							elseif ($perm['_'.$key] == 1)
							{
								$inherited['_'.$key] = 1;
							}
						}
					}

					if (count($inherited) === count(self::$actions))
					{
						return TRUE;
					}
				}
				else
				{
					switch ($perm['_'.$action])
					{
						case -1:
							return FALSE;
						case 0:
							continue;
						case 1:
							return TRUE;
					}
				}
			}
		}

		return FALSE;
	}

	public static function path($object)
	{
		$class = explode('_', get_called_class());
		$table = Inflector::plural(strtolower(array_pop($class)));

		$path = DB::select('parent.id')
			->from(array($table, 'node'))
			->join(array($table, 'parent'))
			->on('node.lft', 'BETWEEN', DB::expr('dotaba_parent.lft AND dotaba_parent.rgt'));

		if (is_string($object))
		{
			$path->where('node.alias', '=', $object);
		}
		else
		{
			$class = explode('_', get_class($object));

			$path->where('node.model', '=', array_pop($class))
				->where('node.foreign_key', '=', $object->id);
		}

		return $path->order_by('parent.lft', 'DESC')
			->execute()
			->as_array();
	}

}