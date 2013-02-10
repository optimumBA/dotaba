<?php defined('SYSPATH') or die('No direct script access.');

class Media_Remote_Hero extends Media_Remote {

	protected static $type, $path;

	protected static $types = array(
		'default' => array(
			'suffix' => '_full',
		),
		'medium' => array(
			'suffix' => '_hphover',
			'size'   => 127,
		),
		'small' => array(
			'suffix' => '_sb',
			'size'   => 59,
		),
	);

}