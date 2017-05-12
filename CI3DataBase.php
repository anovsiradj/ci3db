<?php
namespace anovsiradj;
use Exception, stdClass;

class CI3DataBase
{
	const VERSION = '0.0.1-alpha.1';
	protected static $self_instance;
	protected $db_instance = array();
	protected $dbutil_instance = array();
	protected $dbforge_instance = array();

	protected $db_config = array();
	protected $dbutil_config = array();
	protected $dbforge_config = array();

	protected $db_default;
	protected $dbutil_default;
	protected $dbforge_default;

	protected $db_current;
	protected $dbutil_current;
	protected $dbforge_current;

	protected $ci3_query_builder;

	protected function __construct()
	{
		if (!defined('BASEPATH')) {
			throw new Exception(sprintf('Constant "BASEPATH" (CI3 system directory) is not defined.'));
		}
		require 'files/bootstrap.php';
		require 'files/function.php';
	}

	public static function &init()
	{
		if (!isset(static::$self_instance)) {
			static::$self_instance = new CI3DataBase();
		}
		return static::$self_instance;
	}

	// system/database/DB.php
	public function set_config_file($filepath)
	{
		require $filepath;

		if (!isset($active_group)) $active_group = null;

		if (!isset($db) || !is_array($db)) $db = array();

		$group = $active_group;

		if (count($db) === 0) throw new Exception('No database connection settings were found in the database-config.');
		if (empty($active_group)) throw new Exception('You have not specified a database connection group via $active_group in your database-config.');
		if (!isset($db[$group])) throw new Exception('You have specified an invalid database connection group (' . $group . ') in your database-config.');

		foreach ($db as $k => $v) $this->set_config($k, $v);

		if (!isset($this->db_default)) $this->db_default = $active_group;
		if (!isset($this->db_current)) $this->db_current = $active_group;
	}
	// system/database/DB.php
	public function set_config($group = null, $db = array())
	{
		$this->db_config[$group] = $db;
	}

	public static function &db($group = null)
	{
		return static::init()->db_initialize($group);
	}
	// system/core/Loader.php CI_Loader:database()
	protected function &db_initialize($group)
	{
		if (empty($group)) $group = static::$self_instance->db_default;
		if (!isset($this->db_config[$group])) throw new Exception('You have specified an invalid database connection group (' . $group . ') in your database-config.');
		if (isset($this->db_instance[$group])) return $this->db_instance[$group];

		$params = $this->db_config[$group];
		$driver_file = BASEPATH.'database/drivers/'.$params['dbdriver'].'/'.$params['dbdriver'].'_driver.php';
		if (!file_exists($driver_file)) {
			throw new Exception(sprintf('Invalid DB driver (%s)', $params['dbdriver']));
		}
		require_once($driver_file);

		// Instantiate the DB adapter
		$driver = 'CI_DB_'.$params['dbdriver'].'_driver';
		$DB = new $driver($params);

		if (!empty($DB->subdriver))
		{
			$driver_file = BASEPATH.'database/drivers/'.$DB->dbdriver.'/subdrivers/'.$DB->dbdriver.'_'.$DB->subdriver.'_driver.php';
			if (file_exists($driver_file))
			{
				require_once($driver_file);
				$driver = 'CI_DB_'.$DB->dbdriver.'_'.$DB->subdriver.'_driver';
				$DB = new $driver($params);
			}
		}

		$DB->initialize();
		return $DB;
	}

	// system/core/Loader.php CI_Loader:dbutil()
	public static function &dbutil($db = NULL, $return = FALSE)
	{
		static::init();

		// todo
		$class = new stdClass();
		return $class;
	}

	// system/core/Loader.php CI_Loader:dbforge()
	public static function &dbforge($db = NULL, $return = FALSE)
	{
		static::init();

		// todo
		$class = new stdClass();
		return $class;
	}
}
