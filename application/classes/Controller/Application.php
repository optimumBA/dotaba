<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Application extends Controller {

	/**
	 * Designates which template file to use
	 * @var string
	 */
	protected $_template = 'template';

	/**
	 * Designates which layout file to use.
	 * Needed only if the default template is used.
	 * @var string
	 */
	protected $_layout = 'default';

	/**
	 * HTML title
	 * @var string
	 */
	protected $_title;

	/**
	 * Template content
	 * @var string
	 */
	protected $_content;

	/**
	 * Clean $_POST variable
	 * @var array
	 */
	protected $_post;

	/**
	 * User instance
	 * @var User
	 */
	protected $_user;

	/**
	 * Flash messages
	 * @var array
	 */
	protected $_messages;

	public function before()
	{
		// Set values for instance variables
		$this->_post     = Arr::map('strip_tags', Arr::map('trim', $this->request->post()));
		$this->_user     = User::instance();
		$this->_messages = Session::instance()->get_once('messages', array());

		$this->maintenance();
		$this->csrf();
	}

	public function after()
	{
		$this->template();

		// Save the fresh instance of User ORM model in session
		$this->_user->refresh();
	}

	private function maintenance()
	{
		// Redirect to '/offline' if site is under maintenance and user isn't admin.
		// If the site is soon going under maintenance, show the message to user.
		$maintenance = Kohana::$config->load('site.maintenance');

		if ( ! in_array($this->request->action(), array('offline', 'prijava', 'odjava')) AND $maintenance['start'] AND
			strtotime($maintenance['start']) <= time() AND ( ! $maintenance['end'] OR strtotime($maintenance['end']) >= time()) AND
			( ! $this->_user->logged_in() OR ! $this->_user->has_role('Administrator/ica')))
		{
			$this->redirect('offline');
		}
		elseif ($maintenance['start'] AND strtotime($maintenance['start']) > time())
		{
			$date_format = Kohana::$config->load('site.date_format');
			$this->_messages['maintenance'] = array(
				'type'  => 'notice',
				'value' => 'Rad stranice će biti obustavljen radi dodatnih radova od '
					.date($date_format, strtotime($maintenance['start'])).' do '
					.(($maintenance['end']) ? date($date_format, strtotime($maintenance['end'])) : 'daljnjeg').'.',
			);
		}
	}

	private function csrf()
	{
		// Check the CSRF token for POST requests
		if ($this->request->method() === Request::POST AND ! Security::check($this->_post['csrf']))
		{
			$this->_messages[] = array(
				'type'   => 'error',
				'value'  => 'Samo probaj još jednom ako smiješ',
			);

			Session::instance()->set('messages', $this->_messages);

			$this->redirect();
		}
	}

	private function template()
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

			$view = View::factory($this->_template, array('title' => $this->_title, 'messages' => $this->_messages));

			// If template is the default one, assign the variables to it
			if ($this->_template == 'template')
			{
				$view->layout = View::factory('layouts/'.$this->_layout, array('content' => $this->_content));
			}
			elseif ($this->_template == 'maintenance')
			{
				$view->date = $site_config['maintenance']['end'];
			}

			$this->response->body($view);
			$this->check_cache();
		}
		elseif ($this->request->is_ajax())
		{
			$this->response->body(json_encode($this->_content));
		}
		else
		{
			$this->response->body($this->_content);
		}
	}

	protected function deny_access()
	{
		if ($this->_user->logged_in())
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Nemaš potrebna dopuštenja.',
			);

			Session::instance()->set('messages', $this->_messages);

			$this->redirect();
		}
		else
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Nisi prijavljen/na.',
			);

			Session::instance()->set('messages', $this->_messages);
			Session::instance()->set('redirect', $this->request->uri());

			$this->redirect('provjera');
		}
	}

	public static function redirect($uri = '', $code = 302)
	{
		if (Request::current()->is_ajax())
		{
			die(json_encode(array(
				'STATUS' => 'REDIRECT',
				'URI'    => $uri,
			)));
		}
		else
		{
			parent::redirect($uri, $code);
		}
	}

}