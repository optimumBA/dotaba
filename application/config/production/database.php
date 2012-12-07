<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'default' => array
	(
		'type'       => 'PDO',
		'connection' => array(
			'dsn'        => 'mysql:host='.$_SERVER['DB1_HOST'].';dbname='.$_SERVER['DB1_NAME'],
			'username'   => $_SERVER['DB1_USER'],
			'password'   => $_SERVER['DB1_PASS'],
			'persistent' => FALSE,
		),
		'table_prefix' => 'dotaba_',
		'charset'      => 'utf8',
		'caching'      => FALSE,
	),
);