<?php class Routes {
	static private $data = [];
	static private $errorControllerAction = 'ErrorController#error404';

	static function root ($controller_action) {
		self::add('GET', 'root', $controller_action);
	}

	static function add ($method, $url, $controller_action) {
		list($controller_name, $action_name) = explode('#', $controller_action);
		$controller_name = ucfirst($controller_name) . "Controller";
		$controller_action = implode('#_', [$controller_name, $action_name]);

		$url = $method.':'.$url;
		self::verifyDuplicates($url, $controller_action);
		self::$data[$url] = $controller_action;
	}

	static function resources ($resource_name) {
		self::add('GET', 	$resource_name . '/index', 		$resource_name . '#index');
		self::add('GET', 	$resource_name . '/create', 	$resource_name . '#new');
		self::add('POST', 	$resource_name . '/create', 	$resource_name . '#create');
		self::add('GET', 	$resource_name . '/update', 	$resource_name . '#edit');
		self::add('PATCH', 	$resource_name . '/update', 	$resource_name . '#update');
		self::add('DELETE', $resource_name . '/destroy', 	$resource_name . '#destroy');
	}

	static function getControllerAction ($method, $url) {
		$url = $method.':'.$url;
		if (isset(self::$data[$url])) {
			return explode('#', self::$data[$url]);
		}

		require DIR.'/public/404.php'; die;
	}

	static private function verifyDuplicates ($url, $controller_action) {
		if (isset(self::$data[$url])) {
			throw new Exception("Error Adding Route: url already exists; url: $url;", 1);
		}

		$controller_actions = array_values(self::$data);
		
		if (in_array($controller_action, $controller_actions)) {
			throw new Exception("Error Adding Route: controller_action already exists; controller_action: $controller_action;", 1);
		}
	}

	static function path ($url, $params = '') {
		if ($params) $params = '?' . http_build_query($params);
		echo HOST.'/'.$url.$params;
	}

	static function param ($paramName) {
		if(isset($_REQUEST[$paramName])) {
			return $_REQUEST[$paramName];
		}

		return '';
	}

}
