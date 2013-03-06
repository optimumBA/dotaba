<?php defined('SYSPATH') or die('No direct script access.');

class Model_User extends ORM {

	protected $_belongs_to = array(
		'clan' => array(),
	);

	protected $_has_many = array(
		'bans'          => array(),
		'executions'    => array(
			'model'       => 'Ban',
			'foreign_key' => 'executioner_id',
		),
		'featured_hero' => array(
			'model'       => 'Hero',
			'foreign_key' => 'featured_hero_id',
		),
		'matches'       => array(
			'through' => 'slots',
		),
		'news'          => array(),
		'roles'         => array(
			'through' => 'roles_users',
		),
		'slots'         => array(),
		'videos'        => array(),
	);

}