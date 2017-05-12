# Standalone CodeIgniter3 DataBase

Standalone CodeIgniter3 DataBase with monkey-pached technique,
without modifying anything.

### Usage

```php
define('BASEPATH', 'path/to/codeigniter/system/'); // with ending-slash (remember)

$ci3db =& anovsiradj\CI3DataBase::init();

// You can direcly using codeigniter database-config (eg: /codeigniter/application/config/database.php)
$ci3db->set_config_file('path/to/config/database.php');

// or: it's like db(id, config-connection)
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
