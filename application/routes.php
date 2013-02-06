<?php defined('SYSPATH') or die('No direct script access.');

Route::set('news', 'novosti(/<page>)', array('page' => '\d+'))
	->defaults(array(
		'controller' => 'news',
		'action'     => 'index',
	));

Route::set('article', 'novosti/<id>-<title>(/<action>)', array('id' => '\d+', 'title' => '[a-zA-Z0-9_-]+'))
	->defaults(array(
		'controller' => 'news',
		'action'     => 'view',
	));

Route::set('videos', 'vod/snimci(/<action>)(/<page>)', array('action' => 'dodaj', 'page' => '\d+'))
	->defaults(array(
		'controller' => 'videos',
		'action'     => 'index',
	));

Route::set('video', 'vod/snimci/<id>-<name>(/<action>)', array('id' => '\d+', 'name' => '[a-zA-Z0-9_-]+'))
	->defaults(array(
		'controller' => 'videos',
		'action'     => 'view',
	));

Route::set('users', '<action>', array('action' => 'prijava|odjava'))
	->defaults(array(
		'controller' => 'users',
	));

Route::set('default', '(<action>)')
	->defaults(array(
		'controller' => 'pages',
		'action'     => 'home',
	));
	
Route::set('search', '<action>')
	->defaults(array(
		'controller' => 'search',
		'action' 	 => 'index',
));