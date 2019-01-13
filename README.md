# CI3DB

Standalone CodeIgniter3 DataBase Query Builder with monkey-patched technique.

### Usage

```php
// IMPORTANT: "BASEPATH" must end with directory separator.

// without composer
require 'path/to/ci3db/CI3DataBase.php';

// with composer
require 'path/to/vendor/autoload.php';

// then
define('BASEPATH', 'path/to/vendor/codeigniter/framework/system/'); // relative
define('BASEPATH', realpath('path/to/vendor/codeigniter/framework/system') . DIRECTORY_SEPARATOR); // absolute

$ci3db =& anovsiradj\CI3DataBase::init();

$ci3db->set_db_config_file('path/to/config/database.php');
// or
$ci3db->set_db_config('db-server-5', array(
	...
	'host' => 'localhost',
	'user' => 'root',
	'password' => 'root'
	...
));

// Using the query builder
$db =& $ci3db::db();
// or
$db =& $ci3db::db('db-server-5');
// or
$db =& anovsiradj\CI3DataBase::db();
// or
$db =& anovsiradj\CI3DataBase::db('db-server-5');
```

### Development

tested on both `5.6+` and `7.0+`.

probably work on `5.4.8+` (see https://github.com/bcit-ci/CodeIgniter#server-requirements).

tested with `MySQL` and `FirebirdSQL`.

### Caveats

`dbutil()` is not supported.

`dbforge()` is not supported.

DB Cache is not supported.

`DSN` string is not yet available. you have to use array.

### Todo(s)

- Test driver `PDO`
- Test `SQLite3`
- `DSN` support. _ughh!_

# License

[MIT](https://anovsiradj.mit-license.org/2017)
