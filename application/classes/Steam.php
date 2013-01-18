<?php defined('SYSPATH') or die('No direct script access.');

class Steam {

	private static $id, $api_key;

	private static function api_key()
	{
		if ( ! self::$api_key)
		{
			self::$api_key = Kohana::$config->load('steam')->get('api_key');
		}

		return self::$api_key;
	}

	private static function id()
	{
		if ( ! self::$id)
		{
			self::$id = Session::instance()->get('steamid', FALSE);
		}

		return self::$id;
	}

	public static function login()
	{
		if ( ! self::logged_in())
		{
			$config = Kohana::$config->load('steam');

			$openid = new LightOpenID($config->get('domain'));
			$openid->identity = $config->get('provider');

			if ($openid->validate())
			{
				self::$id = substr($openid->identity, strlen($config->get('provider').'/id/'));
				Session::instance()->set('steamid', self::$id);
			}
			else
			{
				HTTP::redirect($openid->authUrl(), 302);
			}
		}
	}

	public static function logged_in()
	{
		return (bool) self::id();
	}

	public static function logout()
	{
		Session::instance()->restart();
	}

	public static function player_summary()
	{
		if ( ! self::logged_in())
		{
			return FALSE;
		}

		$response = json_decode(Request::factory('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/')
			->query(array('key' => self::api_key(), 'steamids' => self::id()))
			->execute()
			->body());

		return $response->response->players[0];
	}

	public static function app_news($count = 5, $max_length = 0, $app_id = NULL)
	{
		if ($app_id === NULL)
		{
			$app_id = Kohana::$config->load('steam')->get('app_id');
		}

		$response = json_decode(Request::factory('http://api.steampowered.com/ISteamNews/GetNewsForApp/v0002/')
			->query(array('appid' => $app_id, 'count' => $count, 'maxlength' => $max_length))
			->execute()
			->body());

		return $response->appnews->newsitems;
	}

}