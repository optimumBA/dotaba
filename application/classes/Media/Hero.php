<?php defined('SYSPATH') or die('No direct script access.');

class Media_Hero extends Media {

	protected static $type, $path;

	public static function get($id, $url, $size = NULL)
	{
		$path = self::path().self::filename($id).self::suffix($size).'.'.self::extension();

		return (file_exists($path))
			? '/'.str_replace(DIRECTORY_SEPARATOR, '/', $path)
			: parent::get($id, $url, 'full');
	}

}