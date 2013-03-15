<?php defined('SYSPATH') OR die('No direct script access.');

class HTML extends Kohana_HTML {

	/**
	 * Converts BBCode in string to HTML
	 * @param  string $str string containing BBCode
	 * @return string      string containing HTML
	 */
	public static function parse_bbcode($str)
	{
		$bbcode = new BBcode;
		return $bbcode->parse($str);
	}

}