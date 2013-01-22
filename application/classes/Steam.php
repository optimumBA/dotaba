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

	public static function match_results($match_id)
	{
		$request = Request::factory('https://dotabuff.com/matches/'.$match_id);

		$request->client()->options(CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = $request->execute()->body();

		$dom = new DOMDocument;
		libxml_use_internal_errors(true);
		$dom->loadHTML($response);

		$xpath = new DomXPath($dom);

		$info = $xpath->query('//div[@id="content-header-secondary"]')->item(0)->getElementsByTagName('dd');
		$stats['info']['id']       = $match_id;
		$stats['info']['type']     = $info->item(0)->nodeValue;
		$stats['info']['mode']     = $info->item(1)->nodeValue;
		$duration = $info->item(2)->nodeValue;
		preg_match('/(\d+):(\d+)/', $duration, $matches);
		$stats['info']['duration'] = $matches[1]*Date::HOUR+$matches[2]*Date::MINUTE;
		$stats['info']['region']   = $info->item(3)->nodeValue;
		$stats['info']['date']     = strtotime($info->item(4)->childNodes->item(0)->getAttribute('datetime'));
		$stats['info']['winner']   = explode(' ', $xpath->query('//div[@class="match-result"]')->item(0)->nodeValue)[0];

		$teams = $xpath->query('//div[@class="team-results"]/section');

		$headers = $teams->item(0)->getElementsByTagName('th');

		for ($i = 2; $i <= 10; $i++)
		{
			$fields[$i - 2] = strtolower($headers->item($i)->nodeValue);
		}

		foreach ($teams as $team)
		{
			$name = ucfirst($team->getAttribute('class'));

			$footers = $team->getElementsByTagName('tfoot')->item(0)->getElementsByTagName('td');

			for ($i = 0; $i <= 8; $i++)
			{
				$stats['teams'][$name][$fields[$i]] = Text::convert_to_number($footers->item($i + 1)->nodeValue);
			}

			$players = $team->getElementsByTagName('tbody')->item(0)->getElementsByTagName('tr');

			for ($i = 0; $i <= 4; $i++)
			{
				$cells = $players->item($i)->getElementsByTagName('td');
				$links = $players->item($i)->getElementsByTagName('a');

				preg_match('/\/players\/(\d+)/', $links->item(0)->getAttribute('href'), $match);
				$stats['players'][$name][$i]['id'] = $match[1];
				$stats['players'][$name][$i]['hero'] = $links->item(3)->nodeValue;

				for ($j = 0; $j <= 8; $j++)
				{
					$stats['players'][$name][$i][$fields[$j]] = Text::convert_to_number($cells->item($j + 4)->nodeValue);
				}

				foreach ($cells->item(13)->getElementsByTagName('div') as $item)
				{
					$stats['players'][$name][$i]['items'][] = $item->getElementsByTagName('a')->item(0)->getElementsByTagName('img')->item(0)->getAttribute('alt');
				}
			}
		}

		return $stats;
	}

}