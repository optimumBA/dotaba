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
		'friends' => array(
			'model'   => 'User',
			'far_key' => 'friend_id',
			'through' => 'friendships',
		),
		'matches' => array(
			'through' => 'slots',
		),
		'news'        => array(),
		'posts'       => array(),
		'friendships' => array(),
		'roles'       => array(
			'through' => 'roles_users',
		),
		'slots'  => array(),
		'topics' => array(),
		'videos' => array(),
	);

	protected $_has_one = array(
		'stream'  => array(),
	);

	public function with_last_match()
	{
		$sub = DB::select(DB::expr('MAX(dotaba_matches.date) as date_min'), 'slots.user_id')
			->from('slots')
			->join('matches', 'LEFT')
			->on('matches.id', '=', 'slots.match_id')
			->group_by('slots.user_id');

		return $this->join(array($sub, 's'), 'LEFT')
			->on('s.user_id', '=', 'id')
			->select('date_min');
	}

}