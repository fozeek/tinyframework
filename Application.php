<?php

namespace TinyFramework;

class Application {

	static private $currentAppId = -1;
	static private $apps = [];
	static private $compute;
	static private $beforeController;

	static public function init($callback) {
		self::$currentAppId++;
		self::$apps[self::$currentAppId]['Service']['Manager'] = Service::getCloneInstance();
		$callback();
		return new self();
	}

	static public function controller($controllerName, $actionName, $callback, $options = []) {
		self::$apps[self::$currentAppId]['Mvc'][$controllerName][$actionName] = ['callable' => $callback, 'options' => $options];
		//self::$compute($controllerName, $actionName, $options);
	}

	static public function compute($callback) {
		self::$compute = $callback;
	}

	static public function beforeController($callback) {
		self::$beforeController = $callback;
	}

	public function run() {
		$route = Service::Request()->route;
		self::beforeController($route);
		call_user_func_array(self::$apps[$route->app]['Mvc'][$route->controller][$route->action]['callable'], $route->params);
	}

}