<?php

spl_autoload_register(function ($class) {
	if (str_ends_with($class, 'Controller')) {
		$class_filename = str_replace('Controller', '_controller', $class);
		$class_filename = strtolower($class_filename);
    	include_once DIR.'/app/controllers/' . $class_filename . '.php';
	}
});
