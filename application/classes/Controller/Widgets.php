<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Widgets extends Controller {

	protected $_content;

	public function before()
	{
		if ($this->request->is_initial())
		{
			HTTP::redirect();
		}
		else
		{
			$this->_content = Cache::instance()->get($this->request->action());
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
			->where('match.processed', '=', FALSE)
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
			Cache::instance()->set($this->request->action(), $this->_content, 10*Date::MINUTE);
		}

		// Execute the "after action" method
		$this->after();

		// Return the response
		return $this->response;
	}

}