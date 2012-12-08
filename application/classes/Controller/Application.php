<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Application extends Controller {

	protected $_title, $_content, $_post;

	public function before()
	{
		$this->_post = Arr::map('Security::xss_clean', Arr::map('trim', $this->request->post()));
	}

	public function after()
	{
		if ($this->request->is_initial() AND ! $this->request->is_ajax())
		{
			$this->response->body(View::factory('template')
				->set('title', $this->_title)
				->set('content', $this->_content)
			);
		}
	}

}