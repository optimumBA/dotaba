<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Widgets extends Controller {

	public function before()
	{
		if ($this->request->is_initial())
		{
			HTTP::redirect();
		}
	}

}