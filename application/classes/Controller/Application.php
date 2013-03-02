<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Application extends Controller {

	protected $_title, $_content, $_post, $_layout = 'default', $_user, $_messages;

	public function before()
	{
		// Set values for instance variables
		$this->_post     = Arr::map('strip_tags', Arr::map('trim', $this->request->post()));
		$this->_user     = Session::instance()->get('user');
		$this->_messages = Session::instance()->get_once('messages', array());

		// Check the CSRF token for POST requests
		if ($this->request->method() === Request::POST AND ! Security::check($this->_post['csrf']))
		{
			$this->_messages[] = array(
				'type'   => 'error',
				'values' => 'Samo probaj još jednom ako smiješ',
			);

			Session::instance()->set('messages', $this->_messages);

			$this->redirect();
		}

		// Set redirection path to current URI for users not logged in
		if ( ! $this->_user AND ( ! in_array($this->request->action(), array('provjera', 'prijava'))))
		{
			Session::instance()->set('redirect', $this->request->uri());
		}

		// Redirect to login page and show message if the action requires authorization
		if ( ! $this->_user AND (in_array($this->request->action(), array('objavi', 'dodaj', 'organiziraj', 'izmijeni', 'prijavi'))))
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Nisi ulogovan/na.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('provjera');
		}

		// Redirect to '/offline' if site is under maintenance and user isn't admin
		$maintenance = Kohana::$config->load('site.maintenance');

		if ( ! in_array($this->request->action(), array('offline', 'prijava')) AND $maintenance['start'] AND
			strtotime($maintenance['start']) <= time() AND strtotime($maintenance['end']) >= time() AND
			( ! $this->_user OR ! $this->_user->has('roles', ORM::factory('role', array('name' => 'Administrator/ica')))))
		{
			HTTP::redirect('offline');
		}
	}

	public function after()
	{
		// If the request is neither internal nor AJAX, render template,
		// else just show the content
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

		// Save the fresh instance of User ORM model in session
		if (Session::instance()->get('user') AND isset($this->_user))
		{
			Session::instance()->set('user', $this->_user);
		}
	}

}