<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Widgets extends Controller {

	protected $_key;

	protected $_content;

	protected $_lifetime;

	public function before()
	{
		if ($this->request->is_initial())
		{
			HTTP::redirect();
		}
		else
		{
			$this->_key = $this->request->action();

			if ($id = $this->request->param('id'))
			{
				$this->_key .= '/'.$id;
			}

			$this->_content  = Cache::instance()->get($this->_key);
			$this->_lifetime = 10*Date::MINUTE;
		}
	}

	public function action_announcements()
	{
		$announcements = ORM::factory('Announcement')
			->with('match')
			->with('stream')
			->with('match:tournament')
			->with('match:radiant_clan')
			->with('match:dire_clan')
			->with('stream:user')
			->where('match.date', '>', DB::expr('NOW()'))
			->where('match.radiant_win', 'IS', NULL)
			->limit(4)
			->order_by('match.date')
			->find_all();

		$this->_content = View::factory('widgets/announcements')
			->set('announcements', $announcements)
			->render();
	}

	public function action_news()
	{
		$news = ORM::factory('News')
			->order_by('id', 'DESC')
			->limit(2)
			->find_all();

		$this->_content = View::factory('widgets/news')
			->set('news', $news)
			->render();
	}

	public function action_videos()
	{
		$videos = ORM::factory('Video')
			->order_by('id', 'DESC')
			->limit(2)
			->find_all();

		$this->_content = View::factory('widgets/videos')
			->set('videos', $videos)
			->render();
	}

	public function action_users()
	{
		$users = ORM::factory('User')
			->order_by(DB::expr('wins / (wins + losses + abandons)'), 'DESC')
			->limit(5)
			->find_all();

		$this->_content = View::factory('widgets/users')
			->set('users', $users)
			->render();
	}

	public function action_friends()
	{
		$user  = ORM::factory('User', $this->request->param('id'));
		$users = $user->friends
			->order_by(DB::expr('wins / (wins + losses + abandons)'), 'DESC')
			->find_all();

		$this->_content = View::factory('widgets/friends')
			->set('users', $users)
			->render();

		$this->_lifetime = Date::DAY;
	}

	public function after()
	{
		$this->response->body($this->_content);
	}

	public function execute()
	{
		// Execute the "before action" method
		$this->before();

		// Determine the action to use
		$action = 'action_'.$this->request->action();

		// If the action doesn't exist, it's a 404
		if ( ! method_exists($this, $action))
		{
			throw HTTP_Exception::factory(404,
				'The requested URL :uri was not found on this server.',
				array(':uri' => $this->request->uri())
			)->request($this->request);
		}

		// Execute the action itself
		if ( ! $this->_content)
		{
			$this->{$action}();

			if (Kohana::$environment === Kohana::PRODUCTION)
			{
				Cache::instance()->set($this->_key, $this->_content, $this->_lifetime);
			}
		}

		// Execute the "after action" method
		$this->after();

		// Return the response
		return $this->response;
	}

}