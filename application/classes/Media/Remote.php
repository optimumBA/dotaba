<?php defined('SYSPATH') or die('No direct script access.');

abstract class Media_Remote extends Media {

	public static function cache($id, $url)
	{
		$image = Request::factory($url)->execute()->body();

		$filename = static::filename($id);
		$default  = static::path().$filename.static::$types['default']['suffix'].'.'.static::extension();

		if (file_put_contents($default, $image) !== FALSE AND @getimagesize($default))
		{
			foreach (static::$types as $key => $value)
			{
				if ($key == 'default')
					continue;

				Image::factory($default)
					->resize($value['size'], $value['size'])
					->save(static::path().$filename.$value['suffix'].'.'.static::extension());
			}
		}
	}

	public static function get($id, $url, $type = NULL)
	{
		$suffix = static::suffix($type);
		$path   = static::path().static::filename($id).$suffix.'.'.static::extension();

		if (file_exists($path))
		{
			$url = '/'.str_replace(DIRECTORY_SEPARATOR, '/', $path);
		}
		else
		{
			$url = str_replace(static::$types['default']['suffix'], $suffix, $url);
		}

		return $url;
	}

}