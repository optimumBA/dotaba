<?php defined('SYSPATH') or die('No direct script access.');

class Media_News extends Media {

	protected static $type, $path;

	public static function get($id, $url = NULL, $size = NULL)
	{
		return self::path().self::filename($id).self::suffix($size).'.'.self::extension();
	}

}