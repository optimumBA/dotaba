<?php defined('SYSPATH') or die('No direct script access.');

Route::set('news', 'novosti(/<action>)(/<page>)', array('action' => 'objavi', 'page' => '\d+'))
	->defaults(array(
		'controller' => 'news',
		'action'     => 'index',
	));

Route::set('article', 'novosti/<id>-<title>(/<action>)', array('id' => '\d+', 'title' => '[a-zA-Z0-9_-]+'))
	->defaults(array(
		'controller' => 'news',
		'action'     => 'view',
	));

Route::set('vods', 'vods')
	->defaults(array(
		'controller' => 'videos',
		'action'	 => 'home',
	));

Route::set('videos', 'vods/snimci(/<action>)(/<page>)', array('action' => 'dodaj', 'page' => '\d+'))
	->defaults(array(
		'controller' => 'videos',
		'action'     => 'index',
	));

Route::set('video', 'vods/snimci/<id>-<name>(/<action>)', array('id' => '\d+', 'name' => '[a-zA-Z0-9_-]+'))
	->defaults(array(
		'controller' => 'videos',
		'action'     => 'view',
	));

Route::set('clans', 'liga/klanovi(/<action>)(/<page>)', array('action' => 'napravi', 'page' => '\d+'))
	->defaults(array(
		'controller' => 'clans',
		'action'     => 'index',
	));

Route::set('clan', 'liga/klanovi/<id>-<name>(/<action>)', array('id' => '\d+', 'name' => '[a-zA-Z0-9_-]+'))
	->defaults(array(
		'controller' => 'clans',
		'action'     => 'view',
	));

Route::set('tournaments', 'liga/turniri(/<action>)(/<page>)', array('action' => 'organiziraj', 'page' => '\d+'))
	->defaults(array(
		'controller' => 'tournaments',
		'action'     => 'index',
	));

Route::set('tournament', 'liga/turniri/<id>-<name>(/<action>)', array('id' => '\d+', 'name' => '[a-zA-Z0-9_-]+'))
	->defaults(array(
		'controller' => 'tournaments',
		'action'     => 'view',
	));

Route::set('matches', 'liga/mecevi(/<action>)', array('action' => 'dodaj'))
	->defaults(array(
		'controller' => 'matches',
		'action'     => 'index',
	));

Route::set('match', 'liga/mecevi/<id>(/<action>)', array('id' => '\d+'))
	->defaults(array(
		'controller' => 'matches',
		'action'     => 'view',
	));

Route::set('users', '<action>', array('action' => 'prijava|odjava'))
	->defaults(array(
		'controller' => 'users',
	));

Route::set('user_profile', 'igraci/<id>', array('id' => '\d+'))
	->defaults(array(
		'controller' => 'users',
		'action'     => 'view',
	));

Route::set('search', 'pretraga')
	->defaults(array(
		'controller' => 'search',
		'action' 	 => 'index',
	));

Route::set('default', '(<action>)')
	->defaults(array(
		'controller' => 'pages',
		'action'     => 'home',
	));
