<?php defined('SYSPATH') or die('No direct script access.');

class Media_Local_Tournament extends Media_Local {

	protected static $type, $path;

	protected static $types = array(
		'default' => array(
			'suffix' => '',
			'rules'  => array(
				array('Upload::image'),
				array('Upload::size', array(':value', '1M')),
				array('Upload::type', array(':value', array('jpg'))),
			),
		),
	);

}