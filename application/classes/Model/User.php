<?php defined('SYSPATH') or die('No direct script access.');

class Model_User extends ORM {

	protected $_belongs_to = array(
		'clan' => array(),
	);

	protected $_has_many = array(
		'applications' => array(),
		'bans'         => array(),
		'comments'     => array(),
		'executions'   => array(
			'model'       => 'Ban',
			'foreign_key' => 'executioner_id',
		),
		'featured_hero' => array(
			'model'       => 'Hero',
			'foreign_key' => 'featured_hero_id',
		),
		'matches' => array(
			'through' => 'slots',
		),
		'news'           => array(),
		'participations' => array(
			'through' => 'participations_users',
		),
		'roles' => array(
			'through' => 'roles_users',
		),
		'slots'  => array(),
		'videos' => array(),
	);

}