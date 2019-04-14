<?php
require __DIR__ . '/../vendor/autoload.php';
define('BASEPATH', __DIR__ . '/../vendor/codeigniter/framework/system/'); // endslash!

$ci3db =& \anovsiradj\CI3DataBase::init();
$ci3db->set_db_config('sqlite3', [
	'dbdriver' => 'sqlite3',
	'database' => (__DIR__ . '/sqlite3.db'),
]);

$dsn = 'sqlite3://whatever/' . __DIR__ . '/sqlite3.db';
$ci3db->set_db_config('sqlite3-dsn', $dsn);

try {
	// throw new Exception('${sqlite_error_string}', 1);
	$db0 =& $ci3db->db('sqlite3');
	$db1 =& $ci3db->db('sqlite3-dsn');
} catch (\Exception $e) {
	echo 'can\'t sqlite3.', PHP_EOL, $e->getMessage(), PHP_EOL;
	die();
}

$db0->simple_query('CREATE TABLE IF NOT EXISTS ci3db_tests(k integer PRIMARY KEY AUTOINCREMENT, v TEXT)');

$db1->insert('ci3db_tests', ['v' => 'lorem ipsum']);
dump($db1->insert_id());

$db0->set('v', 'foo bar')->update('ci3db_tests');
dump($db0->affected_rows());

$q = $db1->from('ci3db_tests')->get();
dump(
	$q->num_rows(),
	$q->row()
);

$q = $db0->where('k !=', null)->delete('ci3db_tests');
dump( $q, $db0->affected_rows() );

$db1->simple_query('DROP TABLE ci3db_tests');

$db0->close();
$db1->close();
