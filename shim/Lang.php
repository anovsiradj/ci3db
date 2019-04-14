<?php
/**
* CI3 Fake Lang(uage) Class
* 
* But you still can using it, with some extra config.
* example:
* $lang =& anovsiradj\CI3DB\Lang::init();
* $lang::$default = 'indonesia';
* $lang::$path = 'myapp/external/ci3/'; // mean myapp/external/ci3/language/indonesia/db_lang.php
* $lang->reload();
* 
* Or if you have a better idea, please make a pull request.
* 
* @see system/core/Lang.php
* 
*/

namespace anovsiradj\CI3DB;

class Lang
{
  protected static $self_instance;
  protected $lang = array();

  public static $default = 'english';
  public static $path = null;

  protected function __construct()
  {
    $this->reload();
  }

  /**
  * @see https://github.com/bcit-ci/codeigniter3-translations
  * for more info and language format file.
  * 
  */
  public function reload()
  {
    $path = BASEPATH;
    if (static::$path !== null) $path = ltrim(static::$path, '/') . '/';

    $file = $path . 'language/' . static::$default . '/db_lang.php';

    if (file_exists($file)) {
      include $file;

      if (isset($lang) === false) $lang = array();

      foreach ($lang as $k => $v) {
        $this->lang[$k] = $v;
      }
    }
  }

  public static function &init()
  {
    if (isset(static::$self_instance) === false) {
      static::$self_instance = new self;
    }

    return static::$self_instance;
  }

  /**
  * to satisfy only
  * 
  */
  public function load() {}

  /**
  * simplified version
  * 
  */
  public function line($k) {
    if (isset($this->lang[$k])) return $this->lang[$k];
    return $k;
  }
}
