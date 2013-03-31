<?php defined('SYSPATH') or die('No direct script access.');

class Media_Remote_Avatar extends Media_Remote {

	protected static $type, $path;

	protected static $types = array(
		'default' => array(
			'suffix' => '_full',
		),
		'medium' => array(
			'suffix' => '_medium',
			'size'   => 64,
		),
		'small' => array(
			'suffix' => '',
			'size'   => 32,
		),
	);

	public static function cache($id, $url)
	{
		if ($url != static::config()->get('default_avatar'))
		{
			parent::cache($id, $url);
		}
	}

	public static function get($id, $url, $type = NULL)
	{
		if ($url == static::config()->get('default_avatar'))
		{
			$url = Media::absolute_to_relative(static::path().'default'.static::suffix($type).'.'.static::extension());
		}
		else
		{
			$url = parent::get($id, $url, $type);
		}

		return $url;
	}

}