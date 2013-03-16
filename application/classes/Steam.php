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

	public static function convert_id($id)
	{
		if (strlen($id) === 17)
		{
			$converted = substr($id, 3) - 61197960265728;
		}
		else
		{
			$converted = '765'.($id + 61197960265728);
		}

		return (string) $converted;
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
		return (bool) Session::instance()->get('user');
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

		$players_summaries = self::players_summaries(self::id());

		return $players_summaries[0];
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

	public static function match_history($account_id, $date_min = NULL, $start_at_match_id = NULL, $matches_requested = 25)
	{
		$matches = array();

		do {
			$response = Request::factory('http://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/V001/');

			$response->client()->options(CURLOPT_ENCODING, 'gzip');

			$response = $response->query(array(
				'key'               => self::api_key(),
				'account_id'        => $account_id,
				'date_min'          => $date_min,
				'start_at_match_id' => $start_at_match_id,
				'matches_requested' => $matches_requested,
			))
				->execute()
				->body();

			$response = json_decode($response);

			$matches = array_merge($matches, $response->result->matches);

			if ($response->result->results_remaining > 0)
			{
				$start_at_match_id = end($response->result->matches)->match_id;
				sleep(1);
			}
		} while ($response->result->results_remaining > 0);

		return $matches;
	}

	public static function match_results($match_id)
	{
		$path = Kohana::$config->load('steam')->get('matches_path').DIRECTORY_SEPARATOR.$match_id.'.json';

		if (file_exists($path))
		{
			$response = file_get_contents($path);
		}
		else
		{
			$response = Request::factory('http://api.steampowered.com/IDOTA2Match_570/GetMatchDetails/V001/')
				->query(array('key' => self::api_key(), 'match_id' => $match_id))
				->execute()
				->body();

			file_put_contents($path, $response);
		}

		$response = json_decode($response);

		if ( ! isset($response->result))
		{
			return FALSE;
		}

		return $response->result;
	}

	public static function heroes()
	{
		$response = json_decode(Request::factory('http://api.steampowered.com/IEconDOTA2_570/GetHeroes/v0001/')
			->query(array('key' => self::api_key(), 'language' => 'en_us'))
			->execute()
			->body());

		return $response->result->heroes;
	}

	public static function items()
	{
		$path = Kohana::$config->load('steam')->get('items_path');

		if ( ! file_exists($path))
		{
			return array();
		}

		$data    = file_get_contents($path);
		$pattern = '/\/\/={113}[^(?:\/\/)]*\/\/ ([\sa-z0-9_-]+)[^(?:\/\/)]*[^"]*"([\sa-z0-9_-]+)"[^{]*{[^"]*"ID"\t{7}"(\d+)"/im';

		preg_match_all($pattern, $data, $matches, PREG_SET_ORDER);

		for ($i = 0; $i < count($matches); $i++)
		{
			$items[$i]['id']             = $matches[$i][3];
			$items[$i]['name']           = $matches[$i][2];
			$items[$i]['localized_name'] = $matches[$i][1];
		}

		return json_decode(json_encode($items));
	}
	
	public static function userinfo($InfoType)
	{
		if(Steam::logged_in()) {
		$user = Session::instance()->get('user');
		return $user->$InfoType;
		
		// Callback: Steam::userinfo('username');
		}

	}

	public static function convert_player_slot($player_slot)
	{
		if ($player_slot > 10)
		{
			$binary = sprintf('%08b', $player_slot);
			$team   = substr($binary, 0, 1);
			$slot   = bindec(substr($binary, 1));

			$result = $team * 5 + $slot;
		}
		else
		{
			$team = $player_slot / 5;
			$slot = $player_slot % 5;

			$result = bindec($team.sprintf('%07b', $slot));
		}

		return $result;
	}

}