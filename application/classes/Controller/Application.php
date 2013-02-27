<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Application extends Controller {

	protected $_title, $_content, $_post, $_layout = 'default', $_user, $_messages;

	public function before()
	{
		$this->_post     = Arr::map('strip_tags', Arr::map('trim', $this->request->post()));
		$this->_user     = Session::instance()->get('user');
		$this->_messages = Session::instance()->get_once('messages', array());

		if ($this->request->method() === Request::POST AND ! Security::check($this->_post['csrf']))
		{
			$this->_messages[] = array(
				'type'   => 'warning',
				'values' => 'Samo probaj još jednom ako smiješ',
			);

			Session::instance()->set('messages', $this->_messages);

			$this->redirect();
		}

		if ( ! $this->_user AND ( ! in_array($this->request->action(), array('provjera', 'prijava'))))
		{
			Session::instance()->set('redirect', $this->request->uri());
		}
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
				->set('messages', $this->_messages)
				->set('layout', View::factory('layouts/'.$this->_layout, array('content' => $this->_content)))
			);
		}
		else
		{
			$this->response->body($this->_content);
		}

		if (Session::instance()->get('user') AND isset($this->_user))
		{
			Session::instance()->set('user', $this->_user);
		}
	}

}