<?php defined('SYSPATH') or die('No direct script access.');

class Media_Remote_Item extends Media_Remote {

	protected static $type, $path;

	protected static $types = array(
		'default' => array(
			'suffix' => '_lg',
		),
	);

}