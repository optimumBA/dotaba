<?php defined('SYSPATH') or die('No direct script access.');

class User {

	private static $instance;

	public static function instance()
	{
		if ( ! self::$instance)
		{
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * 64-bit Steam ID
	 * @var string
	 */
	private $steamid;

	/**
	 * User ORM model
	 * @var Model_User
	 */
	private $user;

	/**
	 * User's roles
	 * @var array
	 */
	private $roles;

	public function __construct()
	{
		$session = Session::instance();
		$this->steamid = $session->get('steamid');
		$this->user    = $session->get('user');
		$this->roles   = $session->get('roles', array());
	}

	public function __get($attribute)
	{
		return $this->get($attribute);
	}

	public function __set($attribute, $value)
	{
		$this->set($attribute, $value);
	}

	public function accountid()
	{
		return (string) substr($this->steamid, 3) - 61197960265728;
	}

	public function get($attribute)
	{
		return ($this->user) ? $this->user->$attribute : FALSE;
	}

	public function has_role($role)
	{
		$has = FALSE;

		foreach ($this->roles as $r)
		{
			if ($role == $r)
			{
				$has = TRUE;
				break;
			}
		}

		return $has;
	}

	public function login()
	{
		if (self::logged_in())
			return $this;

		if ( ! $this->steamid)
		{
			$config = Kohana::$config->load('user');

			$openid = new LightOpenID($config->get('domain'));
			$openid->identity = $config->get('provider');

			if ($openid->validate())
			{
				$this->steamid = substr($openid->identity, strlen($config->get('provider').'/id/'));
			}
			else
			{
				HTTP::redirect($openid->authUrl(), 302);
			}
		}

		$this->user = ORM::factory('user', array('steamid' => $this->steamid));

		if ( ! $this->user->loaded())
		{
			$summary = Steam::players_summaries($this->steamid);

			$this->user->values(array(
				'steamid'    => $this->steamid,
				'accountid'  => $this->accountid(),
				'username'   => $summary->personaname,
				'name'       => (isset($summary->realname)) ? $summary->realname : NULL,
				'location'   => (isset($summary->loccountrycode)) ? $summary->loccountrycode : NULL,
				'profileurl' => $summary->profileurl,
				'avatar'     => $summary->avatarfull,
				'status'     => $summary->personastate,
				'created_at' => DB::expr('NOW()'),
			))->create();

			Media_Remote_Avatar::cache($this->user->id, $this->user->avatar);
		}

		$roles = $this->user->roles->find_all();

		foreach ($roles as $role)
		{
			$this->roles[] = $role->name;
		}

		Session::instance()->set('steamid', $this->steamid)
			->set('user', $this->user)
			->set('roles', $this->roles);

		return $this;
	}

	public function logged_in()
	{
		return (bool) $this->user;
	}

	public function logout()
	{
		Session::instance()->restart();
	}

	public function refresh($from_db = FALSE)
	{
		if ($this->user)
		{
			if ($from_db === TRUE)
			{
				$this->user->reload();
			}

			Session::instance()->set('user', $this->user);
		}
	}

	public function set($attribute, $value = NULL)
	{
		if ($value !== NULL)
		{
			$values = array($attribute => $value);
		}
		else
		{
			$values = $attribute;
		}

		if ($user)
		{
			$this->user->values($values)->update();
		}
	}

}