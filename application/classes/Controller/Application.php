<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Application extends Controller {

	protected $_title, $_content, $_post, $_layout = 'default';

	public function before()
	{
		$this->_post = Arr::map('Security::xss_clean', Arr::map('trim', $this->request->post()));
	}

	public function after()
	{
		if ($this->request->is_initial() AND ! $this->request->is_ajax())
		{
			$site_config = Kohana::$config->load('site');
			$title_format = $site_config->get('title_format');

			if ($this->_title)
			{
				$this->_title = Text::populate($title_format['standard'], array(
					'title'     => $this->_title,
					'site_name' => $site_config->get('site_name')
				));
			}
			else
			{
				$this->_title = Text::populate($title_format['without_title'], array(
					'site_name' => $site_config->get('site_name')
				));
			}

			$this->response->body(View::factory('template')
				->set('title', $this->_title)
				->set('layout', View::factory($this->_layout, array('content' => $this->_content)))
			);
		}
		else
		{
			$this->response->body($this->_content);
		}
	}

}