<?php
require __DIR__ . '/connect.php';
require __DIR__ . '/whoops.php';

/**
* 
* should NO-ERROR occured.
* 
*/

$db =& $ci3db::db('sqlite3-1');

foreach ($db->query('SELECT * FROM employee limit 1')->result() as $data) {};
foreach ($db->query('SELECT * FROM employee limit 1')->result_array() as $data) {}

$db->query('SELECT * FROM employee limit 1')->row();
$db->query('SELECT * FROM employee limit 1')->row_array();

$table = 'employee';

foreach ($db->from($table)->limit(1)->get()->result() as $data) {}
foreach ($db->from($table)->limit(3)->get()->result_array() as $data) {}

$db->get($table)->row();
$db->get($table)->row_array();
