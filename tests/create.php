<?php # php tests/create.php

$cwd = dirname(__FILE__);

require $cwd . '/connect.php';

$ids = array('foobar', 'loremipsum');
$q = array();

foreach ($ids as $id) {
	$q[$id] = $db->query("INSERT INTO t (k,v) VALUES('{$db->escape_str($id)}', '{$id} create sql')");
}

$table = 't';
$key = 'k';
$value = 'v';
$db_current = $ci3db->get_config('db_current');
$db_config = $ci3db->get_config('db_config');
if ($db_config[$db_current]['dbdriver'] === 'ibase') {
	$table = strtoupper($table);
	$key = strtoupper($key);
	$value = strtoupper($value);
}

$q['qb'] = $db->insert($table, array($key => 'key', $value => 'value'));

var_dump($q);
