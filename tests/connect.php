<?php
require __DIR__ . '/../vendor/autoload.php';
define('BASEPATH', __DIR__ . '/../vendor/codeigniter/framework/system/'); // end-slash

/**
* mysql-1 or firebird-1 (default is first index: sqlite3-1)
* 
* @see /my-config-database.php
* 
*/

$ci3db =& anovsiradj\CI3DataBase::init();
$ci3db->set_db_config_file(__DIR__ . '/cfg.php');

$ci3db->set_db_config('sqlite3-1', [
	'dbdriver' => 'sqlite3',
	'database' => (__DIR__ . '/Chinook_Sqlite.sqlite'),
	'pconnect' => true,
]);
