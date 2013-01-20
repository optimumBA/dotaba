<?php defined('SYSPATH') or die('No direct script access.');

class Avatar {

	private static $config, $extension, $path;

	private static function config()
	{
		if ( ! self::$config)
		{
			self::$config = Kohana::$config->load('avatar');
		}

		return self::$config;
	}

	private static function extension()
	{
		if ( ! self::$extension)
		{
			self::$extension = self::config()->get('extension');
		}

		return self::$extension;
	}

	private static function path()
	{
		if ( ! self::$path)
		{
			self::$path = self::config()->get('path');
		}

		return self::$path;
	}

	private static function filename($id)
	{
		return sha1($id);
	}

	public static function cache($id, $url)
	{
		$image = Request::factory($url)->execute()->body();

		$filename = self::filename($id);
		$full     = self::path().$filename.'_full.'.self::extension();

		if (file_put_contents($full, $image) !== FALSE)
		{
			Image::factory($full)
				->resize(64)
				->save(self::path().$filename.'_medium.'.self::extension());

			Image::factory($full)
				->resize(32)
				->save(self::path().$filename.'.'.self::extension());
		}
	}

	public static function get($id, $url, $size = NULL)
	{
		$size = ($size === 'medium' || $size === 'full') ? '_'.$size : NULL;
		$path = self::path().self::filename($id).$size.'.'.self::extension();

		if (file_exists($path))
		{
			$url = '/'.str_replace(DIRECTORY_SEPARATOR, '/', $path);
		}
		else
		{
			$url = str_replace('_full', $size, $url);
		}

		return $url;
	}

	public static function remove($id)
	{
		$filename = self::filename($id);
		$sizes    = ['', '_medium', '_full'];

		foreach ($sizes as $size)
		{
			$path = self::path().$filename.$size.'.'.self::extension();

			if (file_exists($path))
			{
				unlink($path);
			}
		}
	}

}