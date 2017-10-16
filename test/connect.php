<?php # php test/connect.php

require 'vendor/autoload.php';
require 'my-error-handle.php';

// define('BASEPATH', 'vendor/codeigniter/framework/system/'); // relative
define('BASEPATH', realpath('vendor/codeigniter/framework/system') . DIRECTORY_SEPARATOR); // absolute

anovsiradj\CI3DataBase::init()->set_db_config_file('my-config-database.php');

/**
* mysql-1 or firebird-1 (default is first index: mysql-1)
* 
* @see my-config-database.php
* 
*/
$db =& anovsiradj\CI3DataBase::db();
