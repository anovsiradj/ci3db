<?php
namespace anovsiradj;
use Exception, stdClass;

class CI3DataBase
{
	const VERSION = '0.3.0';
	protected static $self_instance;

	protected $db_instance = array();
	// protected $dbutil_instance = array();
	// protected $dbforge_instance = array();

	protected $db_config = array();
	// protected $dbutil_config = array();
	// protected $dbforge_config = array();

	protected $db_default = null;
	protected $db_current = null;

	protected $BASEPATH;

	protected function __construct()
	{
		if (defined('BASEPATH')) {
			$this->BASEPATH = rtrim(BASEPATH, '/\\');
			$cwd = dirname(__FILE__);
			require $cwd . '/files/bootstrap.php';
			require $cwd . '/files/function.php';
		} else {
			throw new Exception('Constant "BASEPATH" (CI3 system path) is not defined.');
		}
	}

	public function db_config_default()
	{
		return array(
			'dsn'   => '',
			'hostname' => 'localhost',
			'username' => 'root',
			'password' => '',
			'database' => '',
			'dbdriver' => '',
			'dbprefix' => '',
			'pconnect' => true,
			'db_debug' => false,
			'cache_on' => false,
			'cachedir' => '',
			'char_set' => 'utf8',
			'dbcollat' => 'utf8_general_ci',
			'swap_pre' => '',
			'encrypt' => false,
			'compress' => false,
			'stricton' => false,
			'failover' => array()
		);
	}

	public static function &init()
	{
		if (isset(static::$self_instance) === false) static::$self_instance = new static;
		return static::$self_instance;
	}

	public function set_config($k, $v)
	{
		if (property_exists($this, $k)) {
			$this->{$k} = $v;
		} else {
			throw new Exception(sprintf('Cannot set config, (%s) variable is not defined', $k));
		}

		return $this;
	}
	public function get_config($k)
	{
		if (property_exists($this, $k)) return $this->{$k};
		else {
			throw new Exception(sprintf('[%s]: Cannot get config, variable is not defined (%s)', __CLASS__, $k));
		}
	}

	public function set_db_config_file($filepath)
	{
		$config = require $filepath;

		foreach ($config as $group => $db) {
			if ($this->db_default === null) $this->db_default = $group;

			$this->set_db_config($group, $db);
		}

		// die();

		// if (!isset($db) || !is_array($db)) $db = array();

		// $group = $active_group;

		// if (count($db) === 0) throw new Exception('No database connection settings were found in the database-config.');
		// if (empty($active_group)) throw new Exception('You have not specified a database connection group via $active_group in your database-config.');
		// if (!isset($db[$group])) throw new Exception('You have specified an invalid database connection group (' . $group . ') in your database-config.');

		// foreach ($db as $k => $v) $this->set_db_config($k, $v);

		// if (!isset($this->db_default)) $this->db_default = $active_group;
		// if (!isset($this->db_current)) $this->db_current = $active_group;
		return $this;
	}

	public function set_db_config($group, $config_or_key, $value = null)
	{
		if (is_array($config_or_key)) {
			if (isset($this->db_config[$group]) === false) {
				$this->db_config[$group] = array();
			}

			// dont override array
			foreach ($config_or_key as $k => $v) {
				$this->db_config[$group][$k] = $v;
			}
		} else {
			$this->db_config[$group][$config_or_key] = $value;
		}

		if ($this->db_default === null) $this->db_default = $group;

		return $this;
	}

	public function get_db_config($group, $key = null)
	{
		if ($key === null) {
			if (isset($this->db_config[$group])) return $this->db_config[$group];
		} else {
			if (isset($this->db_config[$group]) && isset($this->db_config[$group][$key])) return $this->db_config[$group][$key];
		}
		return null;
	}

	public static function &db($group = null)
	{
		if ($group === null) $group = static::init()->get_config('db_default');

		if ($group === null) throw new Exception('No database connection settings were found in the database config.');

		return static::init()->db_init($group);
	}

	/**
	* CI3 DB() clone.
	* 
	* @see https://github.com/bcit-ci/CodeIgniter/blob/develop/system/database/DB.php - DB()
	* @see https://github.com/bcit-ci/CodeIgniter/blob/develop/system/core/Loader.php - CI_Loader:database()
	* 
	*/
	protected function &db_init($group)
	{
		$this->db_current = $group;

		// if (empty($group)) $group = static::$self_instance->db_default;
		// if (!isset($this->db_config[$group])) throw new Exception('You have specified an invalid database connection group (' . $group . ') in your database-config.');
		if (isset($this->db_instance[$group])) return $this->db_instance[$group];

		$params =& $this->db_config[$group];

		// Load the DB driver
		$driver_file = $this->BASEPATH.'/database/drivers/'.$params['dbdriver'].'/'.$params['dbdriver'].'_driver.php';
		if (file_exists($driver_file) === false) {
			throw new Exception(sprintf('Invalid DB driver (%s)', $params['dbdriver']));
		}
		require_once($driver_file);

		// Instantiate the DB adapter
		$driver = 'CI_DB_'.$params['dbdriver'].'_driver';
		$this->db_instance[$group] = new $driver($params);

		// Check for a subdriver
		if ( ! empty($DB->subdriver))
		{
			$driver_file = $this->BASEPATH.'/database/drivers/'.$DB->dbdriver.'/subdrivers/'.$DB->dbdriver.'_'.$DB->subdriver.'_driver.php';

			if (file_exists($driver_file))
			{
				require_once($driver_file);
				$driver = 'CI_DB_'.$DB->dbdriver.'_'.$DB->subdriver.'_driver';
				$this->db_instance[$group] = new $driver($params);
			}
		}

		$this->db_instance[$group]->initialize();
		return $this->db_instance[$group];
	}

	/**
	* Todo(?)
	* @see https://github.com/bcit-ci/CodeIgniter/blob/develop/system/core/Loader.php - CI_Loader:dbutil()
	* 
	*/
	public static function &dbutil($db = NULL, $return = FALSE)
	{
		static::init();

		$class = new stdClass();
		return $class;
	}

	/**
	* Todo(?)
	* @see https://github.com/bcit-ci/CodeIgniter/blob/develop/system/core/Loader.php - CI_Loader:dbforge()
	* 
	*/
	public static function &dbforge($db = NULL, $return = FALSE)
	{
		static::init();

		$class = new stdClass();
		return $class;
	}
}
