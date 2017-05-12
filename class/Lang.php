<?php
namespace anovsiradj\CI3DB;

class Lang
{
	protected static $self_instance;
	protected $lang;

	protected function __construct()
	{
		include BASEPATH . 'language/english/db_lang.php';

		if (!isset($lang)) $lang = array();

		foreach ($lang as $k => $v) {
			$this->lang[$k] = $v;
		}
	}

	public static function &init()
	{
		if (!isset(static::$self_instance)) {
			static::$self_instance = new Lang();
		}
		return static::$self_instance;
	}

	// to satisfy only
	public function load() {}

	public function line($k) {
		if (isset($this->lang[$k])) return $this->lang[$k];
		return $k;
	}
}
