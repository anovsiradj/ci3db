<?php
/*
I cannot use composer autoload-files,
because this file is using a defined constant,
that need to be initialized before this file is loaded.
So, i using the "main-class" itself to load file(s).
*/

require BASEPATH . 'database/DB_driver.php';
require BASEPATH . 'database/DB_query_builder.php';

// to satisfy only
if (!defined('APPPATH')) define('APPPATH', true);

class CI_DB extends CI_DB_query_builder {}
