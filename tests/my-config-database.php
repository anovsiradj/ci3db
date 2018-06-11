<?php
/**
* CI3DB database config file.
* 
* This file must always return `array()` connection configuration.
* 
* There is no `$active_group` option, this library will choose first index (in this example, it was `mysql-1`).
* `$query_builder` option is always `true`, that was the purpose of this library.
* 
*/

return array(
	'mysql-1' => array(
		'dsn'	=> '',
		'hostname' => 'localhost',
		'username' => 'root',
		'password' => 'root',
		'database' => 'ci3db_test',
		'dbdriver' => 'mysqli',
		'dbprefix' => '',
		'pconnect' => FALSE,
		// 'db_debug' => (ENVIRONMENT !== 'production'),
		'db_debug' => true,
		'cache_on' => FALSE,
		'cachedir' => '',
		'char_set' => 'utf8',
		'dbcollat' => 'utf8_general_ci',
		'swap_pre' => '',
		'encrypt' => FALSE,
		'compress' => FALSE,
		'stricton' => FALSE,
		'failover' => array(),
		'save_queries' => TRUE
	),
	'firebird-1' => array(
		'dsn' => '',
		'hostname' => 'localhost',
		'username' => 'sysdba',
		'password' => 'masterkey',
		'database' => '/var/www/database/firebird/ci3db_test.fdb',
		'dbdriver' => 'ibase',
		'dbprefix' => '',
		'pconnect' => TRUE,
		// 'db_debug' => (ENVIRONMENT !== 'production'),
		'db_debug' => true,
		'cache_on' => FALSE,
		'cachedir' => '',
		'char_set' => 'utf8',
		'dbcollat' => 'utf8_general_ci',
		'swap_pre' => '',
		'encrypt' => FALSE,
		'compress' => FALSE,
		'stricton' => FALSE,
		'failover' => array(),
		'save_queries' => TRUE
	)
);

/**
* Default CodeIgniter3 database config file.
* 
* @see https://github.com/bcit-ci/CodeIgniter/blob/develop/application/config/database.php
* 
*/
$active_group = 'db-1';
$query_builder = TRUE;

$db['db-1'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => 'root',
	'database' => 'mydb',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	// 'db_debug' => (ENVIRONMENT !== 'production'),
	'db_debug' => true,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
