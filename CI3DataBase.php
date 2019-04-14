<?php
namespace anovsiradj;

class CI3DataBase
{
	const VERSION = '1.0.0';
	protected static $self_instance;

	protected $db_instance = array();
	protected $dbutil_instance = array();
	protected $dbforge_instance = array();

	protected $db_config = array();
	protected $dbutil_config = array();
	protected $dbforge_config = array();

	protected $db_default = null;
	protected $db_current = null;

	protected $BASEPATH;

	protected function __construct()
	{
		if (defined('BASEPATH')) {
			$this->BASEPATH = BASEPATH;
			require __DIR__ . '/files/bootstrap.php';
			require __DIR__ . '/files/function.php';
		} else {
			throw new \Exception('[CI3DB] Constant "BASEPATH" is required by CodeIgniter3.');
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

	public function set_db_default($group = null)
	{
		$group = $group ?: $this->db_default;

		if (isset($this->db_config[$group])) {
			$this->db_default = $group;
		} else throw new \Exception('[CI3DB] Invalid database connection group ('.$group.').', 1);

		return $this;
	}

	public function get_db_default()
	{
		return $this->db_default;
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
			throw new \Exception(sprintf('[CI3DB] Cannot set config, (%s:%s) variable is not defined.', __CLASS__, $k));
		}

		return $this;
	}
	public function get_config($k)
	{
		if (property_exists($this, $k)) return $this->{$k};
		else {
			throw new \Exception(sprintf('[CI3DB] Cannot get config, variable is not defined (%s:%s)', __CLASS__, $k));
		}
	}


	public function set_db_config_dsn($group, $params)
	{
		// create group if not exists
		if (isset($this->db_config[$group]) === false) $this->db_config[$group] = array();

		if (is_string($params) === FALSE || ($dsn = @parse_url($params)) === FALSE) {
			throw new \Exception(sprintf('[CI3DB] Invalid DB Connection String: %s', $params), 1);
		}
		$this->db_config[$group]['dbdriver'] = @$dsn['scheme'] ?: '';
		$this->db_config[$group]['hostname'] = @$dsn['host'] ?: '';
		$this->db_config[$group]['port'] = @$dsn['port'] ?: '';
		$this->db_config[$group]['username'] = @$dsn['user'] ?: '';
		$this->db_config[$group]['password'] = @$dsn['pass'] ?: '';
		$this->db_config[$group]['database'] = @$dsn['path'] ? (in_array($dsn['path'][0], ['/','\\']) ? substr($dsn['path'], 1) : $dsn['path']) : '';

		// extra?
		if (isset($dsn['query'])) {
			parse_str($dsn['query'], $extra);
			foreach ($extra as $k => $v) {
				if (is_string($v) && preg_match_all('/^(FALSE|TRUE|NULL)|^[0-9\.]+$/', strtoupper($v)) === 1) {
					$v = var_export($v, TRUE);
				}
				$this->db_config[$group][$k] = $v;
			}
		}

		return $this;
	}

	public function set_db_config_file($filepath)
	{
		$config = require $filepath;

		foreach ($config as $group => $db) {
			if ($this->db_default === null) $this->db_default = $group;

			$this->set_db_config($group, $db);
		}

		return $this;
	}

	public function set_db_config($group, $db_dsn_key, $value = null)
	{
		// create group if not exists
		if (isset($this->db_config[$group]) === false) $this->db_config[$group] = array();

		if ($value === null && is_string($db_dsn_key)) {
			$this->set_db_config_dsn($group, $db_dsn_key);

		} elseif (is_array($db_dsn_key)) {
			foreach ($db_dsn_key as $k => $v) {
				$this->db_config[$group][$k] = $v;
			}
		} else {
			$this->db_config[$group][$db_dsn_key] = $value;
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
		static::init()->set_db_default($group);

		return static::init()->db_init(static::init()->get_db_default());
	}

	/**
	* CI3 DB() clone.
	* 
	* @see https://github.com/bcit-ci/CodeIgniter/blob/develop/system/database/DB.php DB()
	* @see https://github.com/bcit-ci/CodeIgniter/blob/develop/system/core/Loader.php CI_Loader:database()
	* 
	* @param string
	* 
	*/
	protected function &db_init($group)
	{
		$this->db_current = $group;

		if (isset($this->db_instance[$group])) return $this->db_instance[$group];

		$params =& $this->db_config[$group];

		// Load the DB driver
		$driver_file = $this->BASEPATH.'/database/drivers/'.$params['dbdriver'].'/'.$params['dbdriver'].'_driver.php';
		if (file_exists($driver_file) === false) {
			throw new \Exception(sprintf('[CI3DB] Invalid DB driver (%s)', $params['dbdriver']));
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

		$class = new \stdClass();
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

		$class = new \stdClass();
		return $class;
	}
}
