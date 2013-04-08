<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Posts extends Controller_Application {

	public function before()
	{
		parent::before();
		$this->_layout = 'news';
	}

	public function action_napravi()
	{
		$topic = ORM::factory('Topic', $this->request->param('id'));

		if ($topic->loaded() AND ( ! $topic->is_hidden OR $this->_user->has_role('Administrator/ica')))
		{
			if ($topic->is_locked == FALSE OR $this->_user->has_role('Administrator/ica'))
			{
				if ($this->_post)
				{
					try
					{
						$this->_post['topic_id']   = $topic->id;
						$this->_post['user_id']    = $this->_user->id;
						$this->_post['created_at'] = DB::expr('NOW()');

						$post = ORM::factory('Post')->values($this->_post, array('content', 'topic_id', 'user_id', 'created_at'))->create();

						$topic->values(array('posts_count' => DB::expr('posts_count + 1'), 'updated_at' => DB::expr('NOW()')))
							->update();

						$this->_messages[] = array(
							'type'  => 'success',
							'value' => 'Post je napravljen.',
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

				$this->_title   = 'Napravi post - '.$topic->name;
				$this->_content = View::factory('posts/napravi')
					->set('values', $this->_post)
					->set('errors', (isset($errors)) ? $errors : array());
			}
			else
			{
				$this->_messages[] = array(
					'type'  => 'error',
					'value' => 'Tema je zaključana.',
				);

				Session::instance()->set('messages', $this->_messages);

				HTTP::redirect('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE));
			}
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Tema nije pronađena.');
		}
	}

	public function action_izmijeni()
	{
		$topic = ORM::factory('Topic', $this->request->param('id'));
		$post  = $topic->posts
			->where('id', '=', $this->request->param('id2'))
			->find();

		if ($topic->loaded() AND ( ! $topic->is_hidden OR $this->_user->has_role('Administrator/ica')))
		{
			if ($post->loaded())
			{
				if ($topic->main_post_id == $post->id)
				{
					HTTP::redirect('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE).'/izmijeni');
				}
				else
				{
					if ($topic->is_locked == FALSE OR $this->_user->has_role('Administrator/ica'))
					{
						if ($this->_post)
						{
							try
							{
								$this->_post['updated_at'] = DB::expr('NOW()');

								$post->values($this->_post, array('content', 'updated_at'))
									->update();

								$this->_messages[] = array(
									'type'  => 'success',
									'value' => 'Post je izmijenjen.',
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

						$this->_title   = 'Izmijeni post - '.$topic->name;
						$this->_content = View::factory('posts/izmijeni')
							->set('values', (empty($this->_post)) ? $post->as_array() : $this->_post)
							->set('errors', (isset($errors)) ? $errors : array());
					}
					else
					{
						$this->_messages[] = array(
							'type'  => 'error',
							'value' => 'Tema je zaključana.',
						);

						Session::instance()->set('messages', $this->_messages);

						HTTP::redirect('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE));
					}
				}
			}
			else
			{
				throw HTTP_Exception::factory(404, 'Post nije pronađen.');
			}
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Tema nije pronađena.');
		}
	}

	public function action_obrisi()
	{
		$topic = ORM::factory('Topic', $this->request->param('id'));
		$post  = $topic->posts
			->where('id', '=', $this->request->param('id2'))
			->find();

		if ($topic->loaded() AND ( ! $topic->is_hidden OR $this->_user->has_role('Administrator/ica')))
		{
			if ($post->loaded())
			{
				if ($topic->main_post_id == $post->id)
				{
					$this->_messages[] = array(
						'type'  => 'warning',
						'value' => 'Da bi obrisao/la prvi post, moraš obrisati cijelu temu.',
					);

					Session::instance()->set('messages', $this->_messages);

					HTTP::redirect('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE));
				}
				else
				{
					if ($this->_user->has_role('Administrator/ica') AND $this->request->method() === Request::POST)
					{
						$post->delete();

						$topic->values(array('posts_count' => DB::expr('posts_count - 1')))
							->update();

						$this->_messages[] = array(
							'type'  => 'success',
							'value' => 'Post je obrisan.',
						);

						Session::instance()->set('messages', $this->_messages);

						HTTP::redirect('teme/'.$topic->id.'-'.URL::title($topic->name, '-', TRUE));
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
			}
			else
			{
				throw HTTP_Exception::factory(404, 'Post nije pronađen.');
			}
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Tema nije pronađena.');
		}
	}

}