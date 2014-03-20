<?php

namespace TinyFramework\Service;

class Request {

	public $route;

	public function __construct() {
		$this->route = new Route();
	}

}