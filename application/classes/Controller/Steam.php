<?php

class Controller_Steam extends Controller_Application {
	
	public function action_index()
	{
		$steam = Steam::instance();
		echo '<pre>'.print_r($steam, TRUE).'</pre>';
	}

	public function action_login()
	{
		$steam = Steam::instance()->login();
		echo '<pre>'.print_r($steam, TRUE).'</pre>';
	}

}