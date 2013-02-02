<?php defined('SYSPATH') or die('No direct script access.');

class Task_Items_Populate extends Minion_Task {

	protected $_options = array(
		'update' => 0,
	);

	protected function _execute(array $params)
	{
		$changes = Model_Item::populate(Steam::items(), $params['update']);

		if ($changes !== FALSE AND $params['update'] == FALSE)
		{
			$config     = Kohana::$config->load('site');
			$site_name  = $config->get('site_name');
			$site_email = $config->get('email');
			$admins     = $config->get('admins');

			$email = Email::factory(Kohana::message('email', 'item_changes'),
				View::factory('email/item_changes')
					->set('changes', $changes)
					->render(),
				'text/html');

			foreach ($admins as $a)
			{
				$email->to($a);
			}
			
			$email->from($site_email, $site_name)
				->send();
		}
	}

}