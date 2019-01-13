<?php
/*
I cannot use Composer autoload-files,
because this file is using a defined constant (BASEPATH),
that need to be initialized before this file is loaded.
So, I am using the CI3DataBase class itself to load file(s).
*/

/**
* 
* define APPPATH to satisfy only
* 
*/
if (!defined('APPPATH')) define('APPPATH', '');

require BASEPATH . 'database/DB_driver.php';
require BASEPATH . 'database/DB_query_builder.php';

/**
* CodeIgniter3 created CI_DB on runtime
* 
* @see https://github.com/bcit-ci/CodeIgniter/blob/develop/system/database/DB.php DB()
* 
*/
class CI_DB extends CI_DB_query_builder {}
