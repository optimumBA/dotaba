<?php defined('SYSPATH') or die('No direct script access.');

class Controller_News extends Controller_Application {

	public function before()
	{
		$this->_layout = 'news';
	}

	public function action_index()
	{
		$news = ORM::factory('news')
			->order_by('created_at', 'DESC')
			->find_all();

		$this->_title 	= 'Novosti';
		$this->_content = View::factory('news/index')
			->set('news', $news);
	}


	public function action_view()
	{
		$article = ORM::factory('news', $this->request->param('id'));

		if ($article->loaded())
		{
			$this->_title 	= $article->title;
			$this->_content = View::factory('news/view')
				->set('article', $article);
		}
	}

}