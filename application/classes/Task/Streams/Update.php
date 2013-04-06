<?php defined('SYSPATH') or die('No direct script access.');

class Task_Streams_Update extends Minion_Task {

	protected function _execute(array $params)
	{
		$streams = ORM::factory('Stream')->find_all();

		foreach ($streams as $stream)
		{
			$response = Request::factory('http://api.justin.tv/api/stream/list.json')
				->query(array('channel' => $stream->channel))
				->execute();

			$channel = json_decode($response);

			if ($channel)
			{
				$values = array(
					'online'  => TRUE,
					'viewers' => $channel[0]->channel_count,
				);
			}
			else
			{
				$values = array(
					'online'  => FALSE,
					'viewers' => 0,
				);
			}

			$stream->values($values)->update();
		}	
	}

}