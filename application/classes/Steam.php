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

	public static function id()
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

	public static function players_summaries($ids)
	{
		$response = json_decode(Request::factory('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/')
			->query(array('key' => self::api_key(), 'steamids' => $ids))
			->execute()
			->body());

		return $response->response->players;
	}

	public static function player_summary()
	{
		if ( ! self::logged_in())
		{
			return FALSE;
		}

		return self::players_summaries(self::id())[0];
	}

	public static function get_avatar($id, $url, $size = NULL)
	{
		$config    = Kohana::$config->load('steam');
		$path      = $config->get('avatars_path').DIRECTORY_SEPARATOR;
		$extension = $config->get('extension');
		$filename  = sha1($id);

		$size = ($size === 'medium' || $size === 'full') ? '_'.$size : NULL;

		$path .= $filename.$size.'.'.$extension;

		if (file_exists($path))
		{
			$url = '/'.str_replace(DIRECTORY_SEPARATOR, '/', $path);
		}
		else
		{
			$url = str_replace('_full', $size, $url);
		}

		return $url;
	}

	public static function cache_avatar($id, $url)
	{
		$image = Request::factory($url)->execute()->body();

		$config    = Kohana::$config->load('steam');
		$path      = $config->get('avatars_path').DIRECTORY_SEPARATOR;
		$extension = $config->get('extension');
		$filename  = sha1($id);

		$full = $path.$filename.'_full.'.$extension;

		if (file_put_contents($full, $image) !== FALSE)
		{
			Image::factory($full)
				->resize(64)
				->save($path.$filename.'_medium.'.$extension);

			Image::factory($full)
				->resize(32)
				->save($path.$filename.'.'.$extension);
		}
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