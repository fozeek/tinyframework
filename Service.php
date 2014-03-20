<?php

namespace TinyFramework;

class Service {

	static private $services = [];

	static public function add($name, $service = null) {
		if(is_array($name)) {
			foreach ($name as $key => $value) {
				self::add($key, $value);
			}
		}
		else {
			self::$services[ucfirst($name)] = $service;
		}
	}

	static public function get($name) {
		if(array_key_exists($name, self::$services)) {
			return self::$services[$name];
		}
		else {
			return false;
		}
	}

	static function __callStatic($name, $args) {
		if(array_key_exists($name, self::$services)) {
			$service = self::$services[$name];
			if(count($args)>0)
				return $service($args);
			else
				return $service;
		}
		else {
			return false;
		}
	}
}