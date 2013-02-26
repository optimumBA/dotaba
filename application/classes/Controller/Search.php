<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Search extends Controller_Application {
	
	public function before()
	{
		parent::before();
		$this->_layout	= 'search';
	}
	
	public function action_index()
	{
		$this->_title	= 'Pretraga';
		$this->_content	= View::factory('search/index');
	}
		
	
}
