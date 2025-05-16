<?php class Controller {

	public static function __callStatic ($methodName, $arguments) {

		$className = get_called_class();
		$methodName = str_replace('_', '', $methodName);

        if (method_exists($className, $methodName)) {
            $result = forward_static_call_array([$className, $methodName], $arguments);
        } else {
            throw new Exception("Método '$methodName' não encontrado");
        }

        self::renderView($className, $methodName);

        return $result;
	}

	private static function renderView ($className, $methodName) {
		$className = strtolower(str_replace('Controller', '', $className));
		require_once DIR.'/app/views/'.$className.'/'.$methodName.'.php';
	}
}
