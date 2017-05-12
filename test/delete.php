<?php
require 'vendor/autoload.php';
require 'my-error-handle.php';

define('BASEPATH', realpath('vendor/codeigniter/framework/system') . DIRECTORY_SEPARATOR);

$ci3db =& anovsiradj\CI3DataBase::init();
$ci3db->set_config_file('my-config-database.php');

$db =& $ci3db::db();

$db->query('DELETE FROM t WHERE k = "foobar"');
$db->query('DELETE FROM t WHERE k = "loremipsum"');

$db->delete('t', array('k' => 'key'));
