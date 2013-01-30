<?php defined('SYSPATH') or die('No direct script access.');

class Controller_News extends Controller_Application {

	public function before()
	{
		$this->_layout = 'different_eki';
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

		$this->_title = 'Novosti';
		$this->_content = View::factory('news/index')
			->set('news', $news)
			/*->set('pagination', $pagination)*/;
	}

}