<?php defined('SYSPATH') or die('No direct script access.');

Route::set('news', 'novosti(/<id>-<title>(/<action>))', array('title' => '[a-zA-Z0-9_-]+'))
	->defaults(array(
		'controller' => 'news',
		'action'     => 'index',
	));