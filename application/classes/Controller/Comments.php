<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Comments extends Controller_Application {

	public function action_dodaj()
	{
		if ($this->_post)
		{
			try
			{
				$this->_post['user_id']    = $this->_user->id;
				$this->_post['created_at'] = DB::expr('NOW()');

				$comment = ORM::factory('comment')
					->values($this->_post, array('body', 'object_id', 'object_type', 'user_id', 'created_at'))
					->create();

				$this->_messages[] = array(
					'type'  => 'success',
					'value' => 'Komentar je poslan.',
				);
			}
			catch (ORM_Validation_Exception $e)
			{
				$this->_messages[] = array(
					'type'  => 'error',
					'value' => 'Nepravilan unos.',
				);

				$errors = $e->errors('models');
			}

			Session::instance()->set('messages', $this->_messages);

			HTTP::redirect($this->request->referrer());
		}
		else
		{
			HTTP::redirect();
		}
	}

}