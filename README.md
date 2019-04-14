# CI3DB

Standalone CodeIgniter3 DataBase Query Builder with monkey-patched technique.

### Usage

```php
// IMPORTANT: "BASEPATH" must end with slash or directory separator.
define('BASEPATH', 'path/to/vendor/codeigniter/framework/system/'); // relative
define('BASEPATH', realpath('/path/to/vendor/codeigniter/framework/system') . DIRECTORY_SEPARATOR); // absolute

$ci3db =& \anovsiradj\CI3DataBase::init();

$ci3db->set_db_config_file('path/to/config/database.php'); // see ./tests/cfg.php
// or
$ci3db->set_db_config('db-server-0', array(
	...
	'dbdriver' => '...',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => 'root',
	'database' => '...',
	...
));
// or
$ci3db->set_db_config('db-server-1', 'dbdriver://username:password@hostname/database');

// Using the query builder
$db =& $ci3db->db(); // or
$db =& $ci3db->db('db-server-0'); // or
$db =& \anovsiradj\CI3DataBase::db(); // or
$db =& \anovsiradj\CI3DataBase::db('db-server-1');
```

### Development

tested on `5.6+`,`7.0+` and `7.2+`.

probably work on `5.4.8+` (see <https://github.com/bcit-ci/CodeIgniter#server-requirements>).

tested with `MySQL`, `SQLite` and `FirebirdSQL`.

### Caveats

`dbutil()` is not supported.

`dbforge()` is not supported.

DB Cache is not supported.

`DSN` you must provide `host` (even for `sqlite3`).

### Todo(s)

- Test driver `PDO`
- Test `PostgreSQL`

# License

[MIT](https://anovsiradj.mit-license.org/2017-2019)

[CodeIgniter3 License](https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst)
