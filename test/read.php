<?php
require 'vendor/autoload.php';
require 'my-error-handle.php';

define('BASEPATH', realpath('vendor/codeigniter/framework/system') . DIRECTORY_SEPARATOR);

$ci3db =& anovsiradj\CI3DataBase::init();
$ci3db->set_config_file('my-config-database.php');

$db =& $ci3db::db();

$db->query('SELECT * FROM t')->result();
$db->query('SELECT * FROM t')->result_array();

$db->query('SELECT * FROM t')->row();
$db->query('SELECT * FROM t')->row_array();

$db->get('t')->result();
$db->get('t')->result_array();

$db->get('t')->row();
$db->get('t')->row_array();
