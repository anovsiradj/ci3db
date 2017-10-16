<?php # php test/delete.php

require 'connect.php';

$ids = array('foobar', 'loremipsum');
$q = array();

foreach ($ids as $id) {
	$q[$id] = $db->query("DELETE FROM t WHERE k = '{$db->escape_str($id)}'");
}

$table = 't';
$key = 'k';
$ci3db = anovsiradj\CI3DataBase::init();
$db_current = $ci3db->get_config('db_current');
$db_config = $ci3db->get_config('db_config');
if ($db_config[$db_current]['dbdriver'] === 'ibase') {
	$table = strtoupper($table);
	$key = strtoupper($key);
}

$q['qb'] = $db->delete($table, array($key => 'key'));

var_dump($q);
