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

	public static function players_summaries($ids)
	{
		$response = Request::factory('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/');

		$response->client()->options(CURLOPT_ENCODING, 'gzip');

		$response = json_decode($response
			->query(array('key' => self::api_key(), 'steamids' => $ids))
			->execute()
			->body());

		return $response->response->players;
	}

	public static function friends_list($id)
	{
		$response = Request::factory('http://api.steampowered.com/ISteamUser/GetFriendList/v0001/');

		$response->client()->options(CURLOPT_ENCODING, 'gzip');

		$response = json_decode($response
			->query(array('key' => self::api_key(), 'steamid' => $id, 'relationship' => 'friend'))
			->execute()
			->body());

		return (isset($response->friendslist) AND isset($response->friendslist->friends)) ? $response->friendslist->friends : array();
	}

	public static function match_history($account_id, $date_min = NULL)
	{
		$matches       = array();
		$last_response = '';

		do
		{
			do
			{
				$response = Request::factory('http://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/V001/');

				$response->client()->options(CURLOPT_ENCODING, 'gzip');

				$response = $response->query(array(
					'key'               => self::api_key(),
					'account_id'        => $account_id,
					'date_min'          => $date_min,
					'start_at_match_id' => (isset($start_at_match_id)) ? $start_at_match_id : NULL,
					'date_max'          => (isset($date_max)) ? $date_max : NULL,
				))
					->execute()
					->body();

				if ($response == $last_response)
					break;

				$last_response = $response;

				$response = json_decode($response);

				if (isset($response->result->matches))
				{
					$matches = array_merge($matches, $response->result->matches);

					if ($response->result->results_remaining > 0)
					{
						$last_match        = end($response->result->matches);
						$start_at_match_id = $last_match->match_id;
						$date_max          = $last_match->start_time;

						sleep(1);
					}
				}
			} while ($response->result->results_remaining > 0);
		} while ($response->result->total_results == 500);

		return $matches;
	}

	public static function match_results($match_id)
	{
		$matches_path = Kohana::$config->load('steam')->get('matches_path');

		if ( ! file_exists($matches_path))
		{
			mkdir($matches_path);
		}

		$path = $matches_path.DIRECTORY_SEPARATOR.$match_id.'.json';

		if (file_exists($path))
		{
			$response = file_get_contents($path);
		}
		else
		{
			$response = Request::factory('http://api.steampowered.com/IDOTA2Match_570/GetMatchDetails/V001/');

			$response->client()->options(CURLOPT_ENCODING, 'gzip');

			$response = $response
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
		$response = Request::factory('http://api.steampowered.com/IEconDOTA2_570/GetHeroes/v0001/');

		$response->client()->options(CURLOPT_ENCODING, 'gzip');

		$response = json_decode($response
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
		$pattern = '/\/\/={113}[^(?:\/\/)]*\/\/ ([:\sa-z0-9_-]+)[^(?:\/\/)]*[^"]*"([\sa-z0-9_-]+)"[^{]*{[^"]*"ID"\t{7}"(\d+)"/im';

		preg_match_all($pattern, $data, $matches, PREG_SET_ORDER);

		for ($i = 0; $i < count($matches); $i++)
		{
			$items[$i]['id']             = $matches[$i][3];
			$items[$i]['name']           = $matches[$i][2];
			$items[$i]['localized_name'] = $matches[$i][1];
		}

		return json_decode(json_encode($items));
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