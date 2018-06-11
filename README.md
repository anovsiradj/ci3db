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

// Initialize
$ci3db =& anovsiradj\CI3DataBase::init();

$ci3db->set_config_file('path/to/config/database.php');
// or
$ci3db->set_config('db-server-5', array(
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

This library is tested on `PHP7`. Probably work on `PHP5`.

This library is tested with `MySQL` and `FirebirdSQL`.

```bash
git clone ...THIS...
cd ci3db

# install
composer install --prefer-dist

# run test `php tests/*.php`
php tests/connect.php
php tests/create.php
php tests/read.php
php tests/update.php
php tests/read.php
php tests/delete.php
```

Database Structure

- Create database with name `ci3db_test`.
- Create table with name `t`.
- Create column `k` type `varchar(100)` and column `v` type `text`.
- Set column `k` as `Primary Key`.

### Caveats

- `dbutil()` not yet available.
- `dbforge()` not yet available.
- DB Cache is not supported.

### Todo(s)

- Test driver `PDO`
- Test `SQLite`
- Accept `DSN` config and parse it.

# License

[MIT](https://anovsiradj.mit-license.org/2017-2018)
