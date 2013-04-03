<?php defined('SYSPATH') or die('No direct script access.');

class Model_User extends ORM {

	protected $_belongs_to = array(
		'clan' => array(),
		'featured_hero' => array(
			'model'       => 'Hero',
			'foreign_key' => 'featured_hero_id',
		),
	);

	protected $_has_many = array(
		'applications' => array(),
		'bans'         => array(),
		'comments'     => array(),
		'executions'   => array(
			'model'       => 'Ban',
			'foreign_key' => 'executioner_id',
		),
		'giveaways' => array(
			'model'       => 'Request',
			'foreign_key' => 'giver_id',
		),
		'matches' => array(
			'through' => 'slots',
		),
		'news'           => array(),
		'participations' => array(
			'through' => 'participations_users',
		),
		'posts'    => array(),
		'requests' => array(),
		'roles'    => array(
			'through' => 'roles_users',
		),
		'slots'  => array(),
		'topics' => array(),
		'videos' => array(),
	);

	protected $_has_one = array(
		'stream' => array(),
	);

}