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
		$tournament = ORM::factory('tournament')
			->with('user')
			->where('tournament.id', '=', $this->request->param('id'))
			->find();

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

	public function action_izmijeni()
	{
		$tournament = ORM::factory('tournament', $this->request->param('id'));

		if ($tournament->loaded() AND $this->_user->has('tournaments', $tournament))
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
		elseif ($tournament->loaded())
		{
			$this->_messages[] = array(
				'type'  => 'alert',
				'value' => 'Nisi organizator/ica ovog turnira.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('liga/klanovi/'.$clan->id.'-'.URL::title($clan->name));
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Turnir nije pronađen.');
		}
	}

	public function action_prijavi()
	{
		$tournament = ORM::factory('tournament', $this->request->param('id'));

		if ($this->request->method() === Request::POST)
		{
			$clan = ORM::factory('clan', array('lord_id' => $this->_user->id));

			if ($clan->loaded())
			{
				$tournament->add('clans', $clan);

				$this->_messages[] = array(
					'type'  => 'success',
					'value' => 'Klan je prijavljen na turnir.',
				);

				Session::instance()->set('messages', $this->_messages);

				HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name));
			}
			else
			{
				$this->_messages[] = array(
					'type'  => 'alert',
					'value' => 'Nisi lord klana.',
				);

				Session::instance()->set('messages', $this->_messages);

				HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name));
			}
		}
		else
		{
			HTTP::redirect('liga/turniri/'.$tournament->id.'-'.URL::title($tournament->name));
		}
	}

}