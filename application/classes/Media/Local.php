<?php defined('SYSPATH') or die('No direct script access.');

abstract class Media_Local extends Media {

	public static function get($id, $type = NULL)
	{
		$suffix = static::suffix($type);
		$path   = static::path().static::filename($id).$suffix.'.'.static::extension();

		return '/'.str_replace(DIRECTORY_SEPARATOR, '/', $path);
	}

	public static function fields($files, $fields)
	{
		if ( ! is_array($fields))
		{
			$fields = array($fields);
		}
		elseif (empty($fields))
		{
			foreach (static::$types as $key => $value)
			{
				if (isset($files[$key]))
				{
					$fields[] = $key;
				}
			}
		}

		return $fields;
	}

	public static function validate($files, $fields = array())
	{
		$files = Validation::factory($files);

		$fields = static::fields($files, $fields);

		foreach ($fields as $field)
		{
			$files->rules($field, static::$types[$field]['rules']);
		}

		return $files;
	}

	public static function save($id, $files, $fields = array())
	{
		$fields    = static::fields($files, $fields);
		$filename  = static::filename($id);

		foreach ($fields as $field)
		{
			$exploded = explode('.', $files[$field]['name']);

			Upload::save($files[$field], $filename.static::suffix($field).'.'.end($exploded), static::path());
		}
	}

}