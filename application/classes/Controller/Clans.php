<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Clans extends Controller_Application {

	public function action_index()
	{
		$count = ORM::factory('clan')->count_all();

		$pagination = Pagination::factory(array(
			'total_items' => $count,
		));

		$clans = ORM::factory('clan')
			->order_by('created_at', 'DESC')
			->limit($pagination->items_per_page)
			->offset($pagination->offset)
			->find_all();

		$this->_title 	= 'Klanovi';
		$this->_content = View::factory('clans/index')
			->set('clans', $clans)
			->set('pagination', $pagination);
	}

	public function action_view()
	{
		$clan = ORM::factory('clan', $this->request->param('id'))
			->with('lord');

		if ($clan->loaded())
		{
			$users = $clan->users->find_all();

			$this->_title 	= $clan->name;
			$this->_content = View::factory('clans/view')
				->set('clan', $clan)
				->set('users', $users);
		}
	}

}