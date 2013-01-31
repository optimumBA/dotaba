<?php defined('SYSPATH') or die('No direct script access.');

class Controller_News extends Controller_Application {

	public function before()
	{
		$this->_layout = 'news';
	}

	public function action_index()
	{
		/*$total = ORM::factory('news')
			->count_all();

		$pagination = Pagination::factory(array(
			'total_items' => $total
		));*/

	$news = Model_News::find_all(NULL, NULL, array('created_at', 'DESC'));
			/*->limit($pagination->items_per_page)
			->offset($pagination->offset)*/

		$this->_title 	= 'Novosti';
		$this->_content = View::factory('news/index')
						->set('news', $news)
			/*->set('pagination', $pagination)*/;
	}


	public function action_view()
	{
		$article = Model_News::find($this->request->param('id'));

		if(!$article === FALSE) {
		$this->_title 	= $article->title;
		$this->_content = View::factory('news/view')
			->set('article', $article);}
	}

}