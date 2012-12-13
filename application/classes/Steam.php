<?php defined('SYSPATH') or die('No direct script access.');

class Steam {

	private static $_instance;

	private $id, $api_key, $session;

	public function __construct()
	{
		$this->api_key = Kohana::$config->load('steam')->get('api_key');
		$this->session = Session::instance();
		$this->id = $this->session->get('steam_id', FALSE);
	}

	public static function instance()
	{
		if ( ! self::$_instance)
		{
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	public static function logged_in()
	{
		return (bool) Session::instance()->get('steam_id', FALSE);
	}

	public function login()
	{
		if (self::logged_in() === TRUE)
		{
			return TRUE;
		}

		$openid = new LightOpenID('dotaba');
		$openid->identity = Kohana::$config->load('steam')->get('provider');

		if ($openid->validate())
		{
			$this->id = substr($openid->identity, 36);
			$this->session->set('steam_id', $this->id);
			return TRUE;
		}
		else
		{
			HTTP::redirect($openid->authUrl(), 302);
		}
	}

	public function logout()
	{
		$this->session->restart();
		self::$instance = new self;
		return TRUE;
	}

	public function id()
	{
		return $this->id;
	}

}