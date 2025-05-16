<?php class Routes {
	static private $data = [];
	static private $errorControllerAction = 'ErrorController#error404';

	static function add ($url, $controller_action) {
		list($controller_name, $action_name) = explode('#', $controller_action);
		$controller_name = ucfirst($controller_name) . "Controller";
		$controller_action = implode('#_', [$controller_name, $action_name]);

		self::verifyDuplicates($url, $controller_action);
		self::$data[$url] = $controller_action;
	}

	static function resources ($resource_name) {
		$crud_actions = ['index', 'new', 'create', 'edit', 'update', 'destroy'];
		
		foreach ($crud_actions as $crud_action) {
			$url = $resource_name . '/' . $crud_action;
			$controller_action = $resource_name . '#' . $crud_action;
			self::add($url, $controller_action);
		}
	}

	static function getControllerAction ($url) {
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

}
