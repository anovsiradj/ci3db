<?php # php test/update.php

require 'connect.php';

// use query builder
$qb = true;
// $qb = false;

$ids = array('foobar', 'loremipsum');
$q = array();

$table = 't';
$key = 'k';
$value = 'v';
$ci3db = anovsiradj\CI3DataBase::init();
$db_current = $ci3db->get_config('db_current');
$db_config = $ci3db->get_config('db_config');
if ($db_config[$db_current]['dbdriver'] === 'ibase') {
	$table = strtoupper($table);
	$key = strtoupper($key);
	$value = strtoupper($value);
}

foreach ($ids as $id) {
	if ($qb) {
		$q[$id] = $db->from($table)->where($key, $id)->set($value, $id . ' update qb')->update();

	} else {
		$q[$id] = $db->query("UPDATE t SET v = '{$id} update sql' WHERE k = '{$db->escape_str($id)}'");

	}
}

$q['qb'] = $db->where($key, 'key')->update($table, array($value => 'value updated'));

var_dump($q);
