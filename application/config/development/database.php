<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'default' => array
	(
		'type'       => 'mysql',
		'connection' => array(
			'hostname'   => 'localhost',
			'database'   => 'dotaba',
			'username'   => 'dotaba',
			'password'   => 'dotaba1234',
			'persistent' => FALSE,
		),
		'table_prefix' => 'dotaba_',
		'charset'      => 'utf8',
		'caching'      => FALSE,
	),
);