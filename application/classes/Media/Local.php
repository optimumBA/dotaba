<?php defined('SYSPATH') or die('No direct script access.');

abstract class Media_Local extends Media {

	public static function get($id, $type = NULL)
	{
		$suffix = static::suffix($type);
		$path   = static::path().static::filename($id).$suffix.'.'.static::extension();

		return '/'.str_replace(DIRECTORY_SEPARATOR, '/', $path);
	}

}