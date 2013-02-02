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
			static::$type = Inflector::plural(strtolower(substr(get_called_class(), 6)));
		}

		return static::$type;
	}

	protected static function suffix($size)
	{
		return ($size === 'medium' || $size === 'full') ? '_'.$size : NULL;
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

	public static function cache($id, $url)
	{
		$image = Request::factory($url)->execute()->body();

		$filename = static::filename($id);
		$full     = static::path().$filename.'_full.'.static::extension();

		if (file_put_contents($full, $image) !== FALSE AND @getimagesize($full))
		{
			Image::factory($full)
				->resize(64)
				->save(static::path().$filename.'_medium.'.static::extension());

			Image::factory($full)
				->resize(32)
				->save(static::path().$filename.'.'.static::extension());
		}
	}

	public static function get($id, $url, $size = NULL)
	{
		$suffix = static::suffix($size);
		$path   = static::path().static::filename($id).$suffix.'.'.static::extension();

		if (file_exists($path))
		{
			$url = '/'.str_replace(DIRECTORY_SEPARATOR, '/', $path);
		}
		else
		{
			$url = str_replace('_full', $suffix, $url);
		}

		return $url;
	}

	public static function remove($id)
	{
		$filename = static::filename($id);
		$suffixes = ['', '_medium', '_full'];

		foreach ($suffixes as $suffix)
		{
			$path = static::path().$filename.$suffix.'.'.static::extension();

			if (file_exists($path))
			{
				unlink($path);
			}
		}
	}

}