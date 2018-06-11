<?php # php tests/read.php

$cwd = dirname(__FILE__);

require $cwd . '/connect.php';

// =========================================

$q1a = $db->query('SELECT * FROM t');
foreach ($q1a->result() as $data) {
	print_r($data);
}

$q1b = $db->query('SELECT * FROM t');
foreach ($q1b->result_array() as $data) {
	print_r($data);
}

// =========================================

print_r($db->query('SELECT * FROM t')->row());

print_r($db->query('SELECT * FROM t')->row_array());

// =========================================
// =========================================

$table = 't';
$db_current = $ci3db->get_config('db_current');
$db_config = $ci3db->get_config('db_config');
if ($db_config[$db_current]['dbdriver'] === 'ibase') $table = strtoupper($table);

// =========================================
// =========================================

$qb1a = $db->from($table)->get();
foreach ($qb1a->result() as $data) {
	print_r($data);
}

$qb1b = $db->from($table)->get();
foreach ($qb1b->result_array() as $data) {
	print_r($data);
}

// =========================================

print_r($db->get($table)->row());
print_r($db->get($table)->row_array());
