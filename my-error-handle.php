<?php
function my_custom_exception_handler($exception) {
	echo 'Uncaught exception: ' , $exception->getMessage(), PHP_EOL;
}

set_exception_handler('my_custom_exception_handler');
