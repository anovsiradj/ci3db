<?php # php tests/connect.php

header('Content-Type: text/plain');

$cwd = dirname(__FILE__);

require $cwd . '/../vendor/autoload.php';
require $cwd . '/my-error-handle.php';

// define('BASEPATH', 'vendor/codeigniter/framework/system/'); // relative
define('BASEPATH', $cwd . '/../vendor/codeigniter/framework/system/');

anovsiradj\CI3DataBase::init()->set_db_config_file($cwd . '/my-config-database.php');

/**
* mysql-1 or firebird-1 (default is first index: mysql-1)
* 
* @see /my-config-database.php
* 
*/
$ci3db =& anovsiradj\CI3DataBase::init();
$db =& anovsiradj\CI3DataBase::db();
