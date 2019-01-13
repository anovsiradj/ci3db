<?php
require __DIR__ . '/../vendor/autoload.php';

define('BASEPATH', __DIR__ . '/../vendor/codeigniter/framework/system/'); // end-slash

anovsiradj\CI3DataBase::init()->set_db_config_file(__DIR__ . '/cfg.php');

anovsiradj\CI3DataBase::init()->set_db_config('sqlite3-1', [
	'database' => ('/var/www/fake.sqlite3')
]);

/**
* mysql-1 or firebird-1 (default is first index: sqlite3-1)
* 
* @see /my-config-database.php
* 
*/

$ci3db =& anovsiradj\CI3DataBase::init();
$db =& anovsiradj\CI3DataBase::db();
