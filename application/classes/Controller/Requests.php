<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Requests extends Controller_Application {

	public function before()
	{
		parent::before();
		$this->_layout = 'news';
	}

	public function action_index()
	{
		$count = ORM::factory('request')
			->where('processed', '=', TRUE)
			->count_all();

		$max = ORM::factory('request')
			->select(DB::expr('COUNT(*) as count'))
			->with('giver')
			->where('processed', '=', TRUE)
			->group_by('giver_id')
			->order_by('count', 'DESC')
			->find();

		$requests = ORM::factory('request')
			->with('user')
			->where('giver_id', 'IS', NULL)
			->where('removed', '=', FALSE)
			->find_all();

		$request = $this->_user->requests
			->with('giver')
			->find();

		$giveaways = $this->_user->giveaways
			->where('processed', '=', FALSE)
			->find_all();

		$this->_title 	= 'Pozivnice';
		$this->_content = View::factory('requests/index')
			->set('count', $count)
			->set('max', $max)
			->set('requests', $requests)
			->set('request', $request)
			->set('giveaways', $giveaways);
	}

	public function action_trazi()
	{
		$request = $this->_user->requests->find();

		if ($request->loaded() AND $request->processed == FALSE AND $request->removed == FALSE)
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Greška.',
			);
		}
		else
		{
			$request->values(array('user_id' => $this->_user->id, 'created_at' => DB::expr('NOW()')))
				->create();

			$this->_messages[] = array(
				'type'  => 'success',
				'value' => 'Zahtjev je poslan.',
			);
		}

		Session::instance()->set('messages', $this->_messages);

		HTTP::redirect('pozivnice');
	}

	public function action_posalji()
	{
		$request      = ORM::factory('request', $this->request->param('id'));
		$user_request = $this->_user->requests->find();

		if ($request->loaded() AND ( ! $user_request->loaded() OR $user_request->processed OR $user_request->removed))
		{
			$request->values(array('giver_id' => $this->_user->id, 'updated_at' => DB::expr('NOW()')))
				->update();

			$this->_messages[] = array(
				'type'  => 'success',
				'value' => 'Poslan je odgovor na zahtjev. Sad trebaš poslati pozivnicu preko Steama.',
			);
		}
		else
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Greška.',
			);
		}

		Session::instance()->set('messages', $this->_messages);

		HTTP::redirect('pozivnice');
	}

	public function action_obrisi()
	{
		$request = ORM::factory('request', $this->request->param('id'));

		if ($request->loaded() AND $this->_user->id == $request->user_id)
		{
			$request->values(array('removed' => TRUE, 'updated_at' => DB::expr('NOW()')))
				->update();

			$this->_messages[] = array(
				'type'  => 'success',
				'value' => 'Zahtjev je obrisan.',
			);
		}
		else
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Greška.',
			);
		}

		Session::instance()->set('messages', $this->_messages);

		HTTP::redirect('pozivnice');
	}

	public function action_otkazi()
	{
		$request = ORM::factory('request', $this->request->param('id'));

		if ($request->loaded() AND $this->_user->id == $request->giver_id)
		{
			$request->values(array('giver_id' => NULL, 'updated_at' => DB::expr('NOW()')))
				->update();

			$this->_messages[] = array(
				'type'  => 'success',
				'value' => 'Slanje pozivnice je otkazano.',
			);
		}
		else
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Greška.',
			);
		}

		Session::instance()->set('messages', $this->_messages);

		HTTP::redirect('pozivnice');
	}

	public function action_zavrsi()
	{
		$request = ORM::factory('request', $this->request->param('id'));

		if ($request->loaded() AND $this->_user->id == $request->user_id AND $request->giver_id)
		{
			$request->values(array('processed' => TRUE, 'updated_at' => DB::expr('NOW()')))
				->update();

			$this->_messages[] = array(
				'type'  => 'success',
				'value' => 'Postupak je završen.',
			);
		}
		else
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Greška.',
			);
		}

		Session::instance()->set('messages', $this->_messages);

		HTTP::redirect('pozivnice');
	}

}