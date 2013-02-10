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

}