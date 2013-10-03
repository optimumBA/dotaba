<?php defined('SYSPATH') or die('No direct script access.');

class Model_Permission extends Model_Database {

	private static $actions = array('create', 'read', 'update', 'delete');

	public static function check($aro, $aco, $action = '*')
	{
		$keys = array('aro' => NULL, 'aco' => NULL);

		foreach ($keys as $key => &$value)
		{
			$object = $$key;

			if (is_string($object))
			{
				$value = $object;
			}
			else
			{
				$class = explode('_', get_class($object));

				$value = Inflector::plural(array_pop($class)).'/'.$object->id;
			}
		}

		$key = sha1($keys['aro'].'_'.$action.'_'.$keys['aco']);

		$permission = Cache::instance()->get($key);

		if ( ! $permission)
		{
			$permission = self::_check($aro, $aco, $action);

			if (Kohana::$environment === Kohana::PRODUCTION)
			{
				Cache::instance()->set($key, $permission, Date::DAY);
			}
		}

		return $permission;
	}

	public static function path($object)
	{
		$path = DB::select('parent.id')
			->from(array(static::$table, 'node'))
			->join(array(static::$table, 'parent'))
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

	public static function add($aro, $aco, $actions = '*')
	{
		if ( ! $aro || ! $aco || $actions !== '*' AND ! is_array($actions))
			return FALSE;

		$aro = Model_Aro::find($aro);
		$aco = Model_Aco::find($aco);

		if ( ! $aro || ! $aco)
			return FALSE;

		$permission = DB::select('id')
			->from('acos_aros')
			->where('aco_id', '=', $aco->id)
			->where('aro_id', '=', $aro->id)
			->as_object()
			->execute()
			->current();

		$values = array();

		if ($permission)
		{
			if ($actions == '*')
			{
				foreach (self::$actions as $action)
				{
					$values['_'.$action] = 1;
				}
			}
			else
			{
				foreach ($actions as $action => $value)
				{
					$values['_'.$action] = $value;
				}
			}

			$result = DB::update('acos_aros')
				->set($values)
				->where('id', '=', $permission->id)
				->execute();

			if ($result)
			{
				$result = array($permission->id, $result);
			}
		}
		else
		{
			foreach (self::$actions as $action)
			{
				$values['_'.$action] = ($actions == '*') ? 1 : Arr::get($actions, $action, 0);
			}

			$result = DB::insert('acos_aros', array_merge(array('aco_id', 'aro_id'), array_keys($values)))
				->values(array_merge(array($aco->id, $aro->id), array_values($values)))
				->execute();
		}

		return $result;
	}

	private static function _check($aro, $aco, $action)
	{
		if ( ! $aro || ! $aco)
			return FALSE;

		if ($action !== '*' AND ! in_array($action, self::$actions))
			return FALSE;

		$aro_path = Model_Aro::path($aro);
		$aco_path = Model_Aco::path($aco);

		if ( ! $aro_path || ! $aco_path)
			return FALSE;

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

	public static function insert($object, $parent_id = NULL)
	{
		DB::query(NULL, 'LOCK TABLE `dotaba_'.static::$table.'` WRITE')->execute();

		if ($parent_id)
		{
			$rgt = DB::select('rgt')
				->from(static::$table)
				->where('id', '=', $parent_id)
				->as_object()
				->execute()
				->current()
				->rgt;
		}
		else
		{
			$rgt = DB::select(DB::expr('COALESCE(MAX(rgt), 0) + 1 as rgt'))
				->from(static::$table)
				->as_object()
				->execute()
				->current()
				->rgt;
		}

		DB::update(static::$table)
			->set(array('lft' => DB::expr('lft + 2')))
			->where('lft', '>=', $rgt)
			->execute();

		DB::update(static::$table)
			->set(array('rgt' => DB::expr('rgt + 2')))
			->where('rgt', '>=', $rgt)
			->execute();

		$values = array();

		if (is_string($object))
		{
			$values['alias'] = $object;
		}
		else
		{
			$class = explode('_', get_class($object));

			$values['model']       = array_pop($class);
			$values['foreign_key'] = $object->id;
		}

		$result = DB::insert(static::$table, array_merge(array_keys($values), array('lft', 'rgt')))
			->values(array_merge(array_values($values), array($rgt, $rgt + 1)))
			->execute();

		DB::query(NULL, 'UNLOCK TABLES')->execute();

		return $result;
	}

	public static function delete($object)
	{
		DB::query(NULL, 'LOCK TABLE `dotaba_'.static::$table.'` WRITE')->execute();

		$node = static::find($object);

		$result = DB::delete(static::$table)
			->where('id', '=', $node->id)
			->execute();

		if ($node->rgt - $node->lft > 1)
		{
			DB::update(static::$table)
				->set(array('lft' => DB::expr('lft - 1'), 'rgt' => DB::expr('rgt - 1')))
				->where('lft', 'BETWEEN', array($node->lft, $node->rgt))
				->execute();
		}

		DB::update(static::$table)
			->set(array('lft' => DB::expr('lft - 2')))
			->where('lft', '>', $node->rgt)
			->execute();

		DB::update(static::$table)
			->set(array('rgt' => DB::expr('rgt - 2')))
			->where('rgt', '>', $node->rgt)
			->execute();

		DB::query(NULL, 'UNLOCK TABLES')->execute();

		$class = explode('_', get_called_class());

		DB::delete('acos_aros')
			->where(strtolower(array_pop($class)).'_id', '=', $node->id)
			->execute();

		return $result;
	}

	public static function find($object)
	{
		$node = DB::select('id', 'lft', 'rgt')
			->from(static::$table);

		if (is_string($object))
		{
			$node->where('alias', '=', $object);
		}
		else
		{
			$class = explode('_', get_class($object));

			$node->where('model', '=', array_pop($class))
				->where('foreign_key', '=', $object->id);
		}

		return $node->as_object()
			->execute()
			->current();
	}

}