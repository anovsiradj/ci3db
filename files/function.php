<?php
// to satisfy only
if (!function_exists('log_message')) {
	function log_message() {}
}

function &load_class($class)
{
	static $instances = array();

	$instance = 'anovsiradj\\CI3DB\\' . $class;

	// basically, this is to trigger php to run autoloader to load/register requested class if it not exist
	class_exists($instance, true);

	$instances[$instance] = $instance::init();
	return $instances[$instance];
}
