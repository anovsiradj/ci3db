<?php
require __DIR__ . '/connect.php';
require __DIR__ . '/whoops.php';

$db =& $ci3db::db('sqlite3-1');

$qq = $db->query("SELECT * from fake_table");
