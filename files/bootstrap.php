<?php
/*
I cannot use Composer autoload-files,
because this file is using a defined constant (BASEPATH),
that need to be initialized before this file is loaded.
So, I am using the CI3DataBase class itself to load file(s).
*/

require BASEPATH . 'database/DB_driver.php';
require BASEPATH . 'database/DB_query_builder.php';

/**
* to satisfy only
* 
*/
if (!defined('APPPATH')) define('APPPATH', true);

/**
* CI3 created this class on runtime
* 
*/
class CI_DB extends CI_DB_query_builder {}
