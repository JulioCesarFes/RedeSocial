<?php class Controller {

	static $layoutView = 'layout';
	static $nextView;
	static $variables;

	public static function __callStatic ($methodName, $arguments) {

		$className = get_called_class();
		$methodName = str_replace('_', '', $methodName);

        if (method_exists($className, $methodName)) {
            self::$variables = forward_static_call_array([$className, $methodName], $arguments);
        } else {
            throw new Exception("Método '$methodName' não encontrado");
        }

        self::renderView($className, $methodName);
	}

	public static function render ($methodName) {
		$className = get_called_class();
		$className = strtolower(str_replace('Controller', '', $className));
        self::$nextView = $className . '/' . $methodName;
	}

	private static function renderView ($className, $methodName) {
		if (!self::$nextView) self::render($methodName);
		require_once DIR.'/app/views/'. self::$layoutView .'.php';
	}

	public static function yield () {
		extract(self::$variables ?? []);
		require_once DIR.'/app/views/'.self::$nextView.'.php';
	}
}
