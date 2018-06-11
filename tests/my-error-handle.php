<?php
function my_custom_exception_handler($exception) {
	echo $exception->getMessage(), PHP_EOL;
}

set_exception_handler('my_custom_exception_handler');
