<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Heroes extends Controller_Application {

	public function before()
	{
		parent::before();
		$this->_layout	= 'heroes';
	}
	
	public function action_index()
	{
		$this->_title	= 'Heroji';
		$this->_content	= View::factory('heroes/index')
						->set('heroes', $heroes);	
	}
	


}