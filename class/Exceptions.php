<?php
/**
* CI3 Fake Exception(s) Class
* 
* @see system/core/Exceptions.php
* 
*/

namespace anovsiradj\CI3DB;

class Exceptions
{
  protected static $self_instance;

  protected function __construct() {}

  public static function &init()
  {
    if (isset(static::$self_instance) === false) static::$self_instance = new static;
    return static::$self_instance;
  }

  /**
  * All errors function, will trought this function.
  * I'am too lazy to make every error function.
  * 
  */
  protected function __default()
  {
    $args = func_get_args();
    $msgs = '[CI3DB/Exceptions:' . array_shift($args) .'] ';

    foreach ($args as $arg) {
      if (is_array($arg)) $msgs .= implode(PHP_EOL, $arg) . PHP_EOL;
      elseif (is_string($arg)) $msgs .= $arg . '.' . PHP_EOL;
    }

    throw new \Exception($msgs);
  }

  public function __call($fn, $args)
  {
    array_unshift($args, $fn);
    call_user_func_array(array($this, '__default'), $args);
  }
}
