<?php defined('SYSPATH') or die('No direct script access.');

class Text extends Kohana_Text {

	/**
	 * Populates string with with values in specified format.
	 * @link   http://php.net/manual/en/function.sprintf.php#81706
	 * @param  string $str  string to be populated
	 * @param  array  $vars values
	 * @param  string $char character used to differentiate keys
	 * @return string       populated string
	 */
	public static function populate($str = '', $vars = array(), $char = ':')
	{
		if ( ! $str)
			return '';

		if ( ! empty($vars))
		{
			foreach ($vars as $key => $value)
			{
				$str = str_replace($char.$key, $value, $str);
			}
		}

		return $str;
	}

	public static function convert_to_number($string)
	{
		$string = str_replace(',', '', $string);
		$map = array('' => 1, 'k' => 1000, 'm' => 1000000);
		list($value, $suffix) = sscanf($string, '%f%s');
		return $value * $map[$suffix];
	}

}