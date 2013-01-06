<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Pages extends Controller_Application {

	public function action_home()
	{
		$this->_content = View::factory('pages/home');
	}

}