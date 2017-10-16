<?php
/**
* CI3 Fake Exception(s) Class
* 
* @see system/core/Exceptions.php
* 
*/

namespace anovsiradj\CI3DB;
use Exception;

class Exceptions
{
	protected static $self_instance;

	protected function __construct() {}

	public static function &init()
	{
		if (!isset(static::$self_instance)) {
			static::$self_instance = new self;
		}
		return static::$self_instance;
	}

	/**
	* All error function, will trought this.
	* I am too lazy to make every error function.
	* 
	*/
	protected function __default()
	{
		$args = func_get_args();
		$args[0] = '@' . $args[0] . '():'; // error caller identifier

		$msgs = '';
		foreach ($args as $arg) {
			if (is_array($arg)) {
				$msgs .= implode(PHP_EOL, $arg) . PHP_EOL;
			} else {
				$msgs .= $arg . PHP_EOL;
			}
		}
		throw new Exception($msgs);
	}

	public function __call($fn, $args)
	{
		array_unshift($args, $fn);
		call_user_func_array(array($this, '__default'), $args);
	}

	/*
	public function show_error($heading, $message)
	{
		if (is_array($message)) {
			$message = implode(PHP_EOL, $message);
		}
		throw new Exception($heading . ':' . PHP_EOL . $message);
	}
	*/
}
