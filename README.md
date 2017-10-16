# Standalone CodeIgniter3 DataBase

Standalone CodeIgniter3 DataBase (Query Builder) with monkey-patched technique,
direcly using CodeIgniter3 PHP scripts.

### Usage

```php
// with ending-slash (remember pls)
define('BASEPATH', 'path/to/codeigniter/system/'); 
// or
define('BASEPATH', 'vendor/codeigniter/framework/system/'); // relative
// or
define('BASEPATH', realpath('vendor/codeigniter/framework/system') . DIRECTORY_SEPARATOR); // absolute


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
// see CI3 DataBase Documentation about manual connection.

$db =& $ci3db::db();
// or
$db =& anovsiradj\CI3DataBase::db();
```

### Clone / Help / Tests / Developer

**Tested with `MySQL` and `FirebirdSQL`.**

Create MySQL database with name `ci3db_test`.
Create table with name `t`.
Create column `k` type `varchar(100)` and `v` type `text`.
Set `k` as `Primary Key`.

```bash
git clone ...URL...
cd ci3db

# install
composer install --prefer-dist

# run test (don't cd to /test/)
php test/*.php
# or 
php test/connect.php
php test/create.php
php test/read.php
php test/update.php
php test/read.php
php test/delete.php
```

### Important Notes

- `dbutil()` not available.
- `dbforge()` not available.
- DB Cache is not supported.

### TODO

- Test driver `PDO`
- Test `SQLite`
- Accept `DSN` config and parse it.

### License

[MIT](https://anovsiradj.mit-license.org/2017-2017)
