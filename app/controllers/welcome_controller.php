<?php class WelcomeController extends ApplicationController {

	static function index () {
		$email = '';
		return get_defined_vars();
	}

	static function signup () {

		$email = Routes::param('email');

		self::render('index');
		return get_defined_vars();
	}

}
