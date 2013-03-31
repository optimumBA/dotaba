<?php defined('SYSPATH') or die('No direct script access.');

abstract class Media {

	private static $config, $extension;

	protected static function config()
	{
		if ( ! self::$config)
		{
			self::$config = Kohana::$config->load('media');
		}

		return self::$config;
	}

	protected static function extension()
	{
		if ( ! self::$extension)
		{
			self::$extension = self::config()->get('extension');
		}

		return self::$extension;
	}

	protected static function type()
	{
		if ( ! static::$type)
		{
			$class = explode('_', get_called_class());
			static::$type = Inflector::plural(strtolower(array_pop($class)));
		}

		return static::$type;
	}

	protected static function suffix($type)
	{
		if ( ! in_array($type, array_keys(static::$types)))
		{
			$type = 'default';
		}

		return static::$types[$type]['suffix'];
	}

	protected static function path()
	{
		if ( ! static::$path)
		{
			static::$path = self::config()->get('path').static::type().DIRECTORY_SEPARATOR;
		}

		if ( ! file_exists(static::$path))
		{
			mkdir(static::$path);
		}

		return static::$path;
	}

	protected static function filename($id)
	{
		return sha1($id);
	}

	public static function remove($id)
	{
		$filename = static::filename($id);

		foreach (static::$types as $suffix)
		{
			$path = static::path().$filename.$suffix.'.'.static::extension();

			if (file_exists($path))
			{
				unlink($path);
			}
		}
	}

	public static function absolute_to_relative($path)
	{
		if ($position = strpos($path, '..'.DIRECTORY_SEPARATOR))
		{
			$path = substr($path, $position + 3);
		}

		return '/'.str_replace(DIRECTORY_SEPARATOR, '/', $path);
	}

}