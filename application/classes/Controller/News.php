<?php defined('SYSPATH') or die('No direct script access.');

class Controller_News extends Controller_Application {

	public function before()
	{
		parent::before();
		$this->_layout = 'news';
	}

	public function action_index()
	{
		$count = ORM::factory('news')->count_all();

		$pagination = Pagination::factory(array(
			'total_items' => $count,
		));

		$news = ORM::factory('news')
			->with('user')
			->order_by('created_at', 'DESC')
			->limit($pagination->items_per_page)
			->offset($pagination->offset)
			->find_all();

		$this->_title 	= 'Novosti';
		$this->_content = View::factory('news/index')
			->set('news', $news)
			->set('pagination', $pagination);
	}


	public function action_view()
	{
		$article = ORM::factory('news')
			->with('user')
			->where('news.id', '=', $this->request->param('id'))
			->find();

		if ($article->loaded())
		{
			$comments = Model_News::comments($article->id);

			$this->_title 	= $article->title;
			$this->_content = View::factory('news/view')
				->set('article', $article)
				->set('comments', $comments);
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Novost nije pronađena.');
		}
	}

	public function action_objavi()
	{
		if ($this->_user->has_role('Novinar/ka'))
		{
			if ($this->_post)
			{
				try
				{
					$files = Media_Local_News::validate($_FILES);

					if ( ! is_uploaded_file($files['default']['tmp_name']) OR $files->check())
					{
						$this->_post['user_id']    = $this->_user->id;
						$this->_post['created_at'] = DB::expr('NOW()');

						$article = ORM::factory('news')
							->values($this->_post, array('title', 'content', 'user_id', 'source', 'url', 'created_at'))
							->create();

						Media_Local_News::save($article->id, $files);

						$this->_messages[] = array(
							'type'  => 'success',
							'value' => 'Novost je objavljena.',
						);

						Session::instance()->set('messages', $this->_messages);

						HTTP::redirect('novosti/'.$article->id.'-'.URL::title($article->title, '-', TRUE));
					}
					else
					{
						$this->_messages[] = array(
							'type'  => 'error',
							'value' => 'Nepravilan unos.',
						);

						$errors = $files->errors('media');
					}
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

			$this->_title   = 'Objavi novost';
			$this->_content = View::factory('news/objavi')
				->set('values', $this->_post)
				->set('errors', (isset($errors)) ? $errors : array());
		}
		else
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Nisi novinar/ka.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('novosti');
		}
	}

	public function action_izmijeni()
	{
		$article = ORM::factory('news', $this->request->param('id'));

		if ($article->loaded() AND $this->_user->has_role('Novinar/ka') AND $article->user_id == $this->_user->id)
		{
			if ($this->_post)
			{
				try
				{
					$files = Media_Local_News::validate($_FILES);

					if ( ! is_uploaded_file($_FILES['default']['tmp_name']) OR $files->check())
					{
						$this->_post['updated_at'] = DB::expr('NOW()');

						$article = ORM::factory('news')
							->values($this->_post, array('title', 'content', 'source', 'url', 'updated_at'))
							->create();

						Media_Local_News::save($article->id, $files);

						$this->_messages[] = array(
							'type'  => 'success',
							'value' => 'Novost je izmijenjena.',
						);

						Session::instance()->set('messages', $this->_messages);

						HTTP::redirect('novosti/'.$article->id.'-'.URL::title($article->title, '-', TRUE));
					}
					else
					{
						$this->_messages[] = array(
							'type'  => 'error',
							'value' => 'Nepravilan unos.',
						);

						$errors = $files->errors('media');
					}
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

			$this->_title   = 'Izmijeni novost - '.$article->title;
			$this->_content = View::factory('news/izmijeni')
				->set('values', (empty($this->_post)) ? $article->as_array() : $this->_post)
				->set('errors', (isset($errors)) ? $errors : array());
		}
		elseif ($article->loaded() AND $this->_user->id != $article->user_id)
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Nisi autor/ica ove novosti.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('novosti/'.$article->id.'-'.URL::title($article->title, '-', TRUE));
		}
		elseif ($article->loaded())
		{
			$this->_messages[] = array(
				'type'  => 'error',
				'value' => 'Nisi novinar/ka.',
			);

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect('novosti/'.$article->id.'-'.URL::title($article->title, '-', TRUE));
		}
		else
		{
			throw HTTP_Exception::factory(404, 'Novost nije pronađena.');
		}
	}

}