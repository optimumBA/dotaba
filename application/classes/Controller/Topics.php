<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Topics extends Controller_Application {

	public function before()
	{
		parent::before();
		$this->_layout = 'news';
	}

	public function action_index()
	{
		$count = ORM::factory('Topic')->count_all();

		$pagination = Pagination::factory(array(
			'total_items' => $count,
		));

		$topics = ORM::factory('Topic')
			->with('user')
			->order_by('is_sticky', 'DESC')
			->order_by('updated_at', 'DESC')
			->limit($pagination->items_per_page)
			->offset($pagination->offset);

		if ( ! $this->_user->has_role('Administrator/ica'))
		{
			$topics->where('is_hidden', '=', FALSE);
		}

		$topics = $topics->find_all();

		$last_posts = array();

		foreach ($topics as $topic)
		{
			$last_posts[$topic->id] = $topic->posts
				->with('user')
				->order_by('created_at', 'DESC')
				->find();
		}

		$this->_title 	= 'Forum';
		$this->_content = View::factory('topics/index')
			->set('topics', $topics)
			->set('last_posts', $last_posts)
			->set('pagination', $pagination);
	}


	public function action_view()
	{
		$topic = ORM::factory('Topic')
			->with('user')
			->where('topic.id', '=', $this->request->param('id'))
			->find();

		if ($topic->loaded() AND ( ! $topic->is_hidden OR $this->_user->has_role('Administrator/ica')))
		{
			$topic->values(array('views_count' => 'views_count + 1'))
				->update();

			$count = $topic->posts->count_all();

			$pagination = Pagination::factory(array(
				'total_items'    => $count,
				'items_per_page' => 10,
			));

			$posts = $topic->posts
				->with('user')
				->limit($pagination->items_per_page)
				->offset($pagination->offset)
				->find_all();

			$this->_title 	= $topic->name;
			$this->_content = View::factory('topics/view')
				->set('topic', $topic)
				->set('posts', $posts)
				->set('pagination', $pagination);
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Tema nije pronađena.');
		}
	}

	public function action_napravi()
	{
		if ($this->_post)
		{
			try
			{
				$this->_post['user_id']    = $this->_user->id;
				$this->_post['created_at'] = DB::expr('NOW()');

				if (isset($this->_post['is_hidden']) AND $this->_user->has_role('Administrator/ica') == FALSE)
				{
					unset($this->_post['is_hidden']);
				}

				$post = ORM::factory('Post')
					->values($this->_post, array('content', 'user_id', 'created_at'))
					->create();

				$this->_post['main_post_id'] = $post->id;
				$this->_post['updated_at']   = $this->_post['created_at'];

				$topic = ORM::factory('Topic')
					->values($this->_post, array('name', 'user_id', 'main_post_id', 'is_hidden', 'created_at', 'updated_at'))
					->create();

				$post->values(array('topic_id' => $topic->id))->update();

				$this->_messages[] = array(
					'type'  => 'success',
					'value' => 'Tema je napravljena.',
				);

				Session::instance()->set('messages', $this->_messages);

				HTTP::redirect('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE));
			}
			catch (ORM_Validation_Exception $e)
			{
				$this->_messages[] = array(
					'type'  => 'error',
					'value' => 'Nepravilan unos.',
				);

				$errors = $e->errors('models');
			}
		}

		$this->_title   = 'Napravi temu';
		$this->_content = View::factory('topics/napravi')
			->set('values', $this->_post)
			->set('errors', (isset($errors)) ? $errors : array());
	}

	public function action_izmijeni()
	{
		$topic = ORM::factory('Topic')
			->with('main_post')
			->where('topic.id', '=', $this->request->param('id'))
			->find();

		if ($topic->loaded() AND ( ! $topic->is_hidden OR $this->_user->has_role('Administrator/ica')))
		{
			if ($this->_user->has_role('Administrator/ica') OR $topic->user_id == $this->_user->id AND $topic->is_locked == FALSE)
			{
				if ($this->_post)
				{
					try
					{
						$this->_post['updated_at'] = DB::expr('NOW()');

						$topic->values($this->_post, array('name', 'updated_at'))
							->update();

						$topic->main_post->values($this->_post, array('content', 'updated_at'))
							->update();

						$this->_messages[] = array(
							'type'  => 'success',
							'value' => 'Tema je izmijenjena.',
						);

						Session::instance()->set('messages', $this->_messages);

						HTTP::redirect('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE));
					}
					catch (ORM_Validation_Exception $e)
					{
						$this->_messages[] = array(
							'type'  => 'error',
							'value' => 'Nepravilan unos.',
						);

						$errors = $e->errors('models');
					}
				}

				$this->_title   = 'Izmijeni temu - '.$topic->name;
				$this->_content = View::factory('topics/izmijeni')
					->set('values', (empty($this->_post)) ? array_merge($topic->main_post->as_array(), $topic->as_array()) : $this->_post)
					->set('errors', (isset($errors)) ? $errors : array());
			}
			else
			{
				if ($topic->user_id != $this->_user->id)
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Nisi autor/ica ove teme.',
					);
				}
				else
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Tema je zaključana.',
					);
				}

				Session::instance()->set('messages', $this->_messages);

				HTTP::redirect('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE));
			}
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Tema nije pronađena.');
		}
	}

	public function action_lock()
	{
		$topic = ORM::factory('Topic', $this->request->param('id'));

		if ($topic->loaded())
		{
			if ($this->_user->has_role('Administrator/ica') AND $this->request->method() === Request::POST)
			{
				$values = array(
					'is_locked'  => ( ! $topic->is_locked),
					'updated_at' => DB::expr('NOW()'),
				);

				$topic->values($values)->update();

				$this->_messages[] = array(
					'type'  => 'success',
					'value' => 'Tema je '.(($topic->is_locked) ? 'zaključana' : 'otključana').'.',
				);
			}

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE));
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Tema nije pronađena.');
		}
	}

	public function action_sticky()
	{
		$topic = ORM::factory('Topic', $this->request->param('id'));

		if ($topic->loaded())
		{
			if ($this->_user->has_role('Administrator/ica') AND $this->request->method() === Request::POST)
			{
				$values = array(
					'is_sticky'  => ( ! $topic->is_sticky),
					'updated_at' => DB::expr('NOW()'),
				);

				$topic->values($values)->update();

				$this->_messages[] = array(
					'type'  => 'success',
					'value' => 'Tema je '.(($topic->is_sticky) ? 'zalijepljena za vrh' : 'odlijepljena s vrha').'.',
				);
			}

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE));
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Tema nije pronađena.');
		}
	}

	public function action_obrisi()
	{
		$topic = ORM::factory('Topic', $this->request->param('id'));

		if ($topic->loaded())
		{
			if ($this->_user->has_role('Administrator/ica') AND $this->request->method() === Request::POST)
			{
				$topic->delete();

				$this->_messages[] = array(
					'type'  => 'success',
					'value' => 'Tema je obrisana.',
				);

				Session::instance()->set('messages', $this->_messages);

				HTTP::redirect('teme');
			}
			else
			{
				if ($this->request->method() === Request::POST)
				{
					$this->_messages[] = array(
						'type'  => 'error',
						'value' => 'Nemaš ovlasti.',
					);
				}

				Session::instance()->set('messages', $this->_messages);

				HTTP::redirect('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE));
			}
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Tema nije pronađena.');
		}
	}

}