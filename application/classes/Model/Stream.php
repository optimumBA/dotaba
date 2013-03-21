<?php defined('SYSPATH') or die('No direct script access.');

class Model_Stream extends ORM {

	protected $_belongs_to = array(
		'user' => array(),
	);

	protected $_has_many = array(
		'matches' => array(
			'through' => 'matches_streams',
		),
	);

	public function labels()
	{
		return array(
			'channel'     => 'Twitch kanal',
			'description' => 'opis',
		);
	}

	public function rules()
	{
		return array(
			'channel' => array(
				array('not_empty'),
				array('alpha_numeric'),
			),
		);
	}

}