<?php
namespace anovsiradj\CI3DB;
use Exception;

class Exceptions
{
	protected static $self_instance;

	protected function __construct() {}

	public static function &init()
	{
		if (!isset(static::$self_instance)) {
			static::$self_instance = new Exceptions();
		}
		return static::$self_instance;
	}

	// system/core/Exceptions.php
	public function show_error($heading, $message)
	{
		if (is_array($message)) {
			$message = implode(PHP_EOL, $message);
		}
		throw new Exception($heading . ':' . PHP_EOL . $message);
	}

}
