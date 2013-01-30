<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Items extends Controller_Application {

	public function before()
	{
		$this->_layout	= 'items';
	}
	
	public function action_index()
	{
		$this->_title	= 'Item-i';
		$this->_content	= View::factory('items/index')
						->set('items', $items);	
	}
	


}