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

Route::set('streams', 'vods/streamovi(/<page>)', array('page' => '\d+'))
	->defaults(array(
		'controller' => 'streams',
		'action'     => 'index',
	));

Route::set('clans', 'liga/klanovi(/<action>)(/<page>)', array('action' => 'napravi', 'page' => '\d+'))
	->defaults(array(
		'controller' => 'clans',
		'action'     => 'index',
	));

Route::set('clan_prijava', 'liga/klanovi/<id>-<name>/prijave/<id2>/<operation>',
	array('id' => '\d+', 'name' => '[a-zA-Z0-9_-]+', 'id2' => '\d+', 'operation' => 'odobri|odbij'))
	->defaults(array(
		'controller' => 'clans',
		'action'     => 'review_application',
	));

Route::set('clan_izbaci', 'liga/klanovi/<id>-<name>/igraci/<id2>/izbaci',
	array('id' => '\d+', 'name' => '[a-zA-Z0-9_-]+', 'id2' => '\d+'))
	->defaults(array(
		'controller' => 'clans',
		'action'     => 'izbaci',
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

Route::set('tournament_prijava', 'liga/turniri/<id>-<name>/prijave/<id2>/<operation>',
	array('id' => '\d+', 'name' => '[a-zA-Z0-9_-]+', 'id2' => '\d+', 'operation' => 'odobri|odbij'))
	->defaults(array(
		'controller' => 'tournaments',
		'action'     => 'review_participation',
	));

Route::set('najavi_match', 'liga/turniri/<id>-<name>/najavi_mec', array('id' => '\d+', 'name' => '[a-zA-Z0-9_-]+'))
	->defaults(array(
		'controller' => 'matches',
		'action'     => 'najavi',
	));

Route::set('matches', 'liga/mecevi')
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

Route::set('user_stream', 'igraci/<id>/stream(/<action>)', array('id' => '\d+'))
	->defaults(array(
		'controller' => 'streams',
		'action'     => 'view',
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

Route::set('comments', 'komentari/<action>', array('action' => 'dodaj'))
	->defaults(array(
		'controller' => 'comments',
	));

Route::set('comment', 'komentari/<id>/<action>', array('id' => '\d+', 'action' => 'obrisi|izmijeni'))
	->defaults(array(
		'controller' => 'comments',
	));

Route::set('requests', 'pozivnice(/<action>)', array('action' => 'trazi'))
	->defaults(array(
		'controller' => 'requests',
		'action'     => 'index',
	));

Route::set('request', 'pozivnice/<id>/<action>', array('id' => '\d+', 'action' => 'posalji|obrisi|otkazi|zavrsi'))
	->defaults(array(
		'controller' => 'requests',
	));

Route::set('topics', 'teme(/<action>)(/<page>)', array('action' => 'napravi', 'page' => '\d+'))
	->defaults(array(
		'controller' => 'topics',
		'action'     => 'index',
	));

Route::set('topic', 'teme/<id>-<name>(/<page>)(/<action>)', array('id' => '\d+', 'name' => '[a-zA-Z0-9_-]+', 'page' => '\d+'))
	->defaults(array(
		'controller' => 'topics',
		'action'     => 'view',
	));

Route::set('posts', 'teme/<id>-<name>/postovi/napravi', array('id' => '\d+', 'name' => '[a-zA-Z0-9_-]+'))
	->defaults(array(
		'controller' => 'posts',
		'action'     => 'napravi',
	));

Route::set('post', 'teme/<id>-<name>/postovi/<id2>/<action>', array('id' => '\d+', 'name' => '[a-zA-Z0-9_-]+', 'id2' => '\d+'))
	->defaults(array(
		'controller' => 'posts',
		'action'     => 'view',
	));

Route::set('widgets', 'widgets/<action>')
	->defaults(array(
		'controller' => 'widgets',
	));

Route::set('default', '(<action>)')
	->defaults(array(
		'controller' => 'pages',
		'action'     => 'home',
	));
