<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Tournaments extends Controller_Application {

	public function action_index()
	{
		$count = ORM::factory('tournament')->count_all();

		$pagination = Pagination::factory(array(
			'total_items' => $count,
		));

		$tournaments = ORM::factory('tournament')
			->order_by('created_at', 'DESC')
			->limit($pagination->items_per_page)
			->offset($pagination->offset)
			->find_all();

		$this->_title 	= 'Turniri';
		$this->_content = View::factory('tournaments/index')
			->set('tournaments', $tournaments)
			->set('pagination', $pagination);
	}

	public function action_view()
	{
		$tournament = ORM::factory('tournament', $this->request->param('id'))
			->with('user');

		if ($tournament->loaded())
		{
			$clans = $tournament->clans->find_all();

			$this->_title 	= $tournament->name;
			$this->_content = View::factory('tournaments/view')
				->set('tournament', $tournament)
				->set('clans', $clans);
		}
	}

	public function action_organiziraj()
	{
		if ($this->_user)
		{
			if ($this->_post)
			{
				try
				{
					$this->_post['user_id']    = $this->_user->id;
					$this->_post['created_at'] = DB::expr('NOW()');

					$tournament = ORM::factory('tournament')
						->values($this->_post, array('name', 'description', 'user_id', 'created_at'))
						->create();

					HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name));
				}
				catch (ORM_Validation_Exception $e)
				{
					$errors = $e->errors('models');
				}
			}

			$this->_title   = 'Organiziraj turnir';
			$this->_content = View::factory('tournaments/organiziraj')
				->set('values', $this->_post)
				->set('errors', ($errors) ? $errors : array());
		}
	}

	public function action_izmijeni()
	{
		$tournament = ORM::factory('tournament', $this->request->param('id'));

		if ($tournament->loaded() AND $this->_user AND $this->_user->has('tournaments', $tournament))
		{
			if ($this->_post)
			{
				try
				{
					$this->_post['updated_at'] = DB::expr('NOW()');

					$tournament->values($this->_post, array('name', 'description', 'updated_at'))
						->update();

					HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name));
				}
				catch (ORM_Validation_Exception $e)
				{
					$errors = $e->errors('models');
				}
			}

			$this->_title   = 'Izmijeni turnir - '.$tournament->name;
			$this->_content = View::factory('tournaments/izmijeni')
				->set('values', (empty($this->_post)) ? $tournament->as_array() : $this->_post)
				->set('errors', ($errors) ? $errors : array())
				->set('tournament', $tournament);
		}
	}

}