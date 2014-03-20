<?php

	require 'Application.php';
	require 'Service.php';
	require 'Service/Request.php';
	require 'Service/Route.php';
	require 'bootstrap.php';

	#
	#	Multiple apps processing
	#	Simple features
	#	Simple APIs for Service developpement
	#	Fast PHP framework
	#	Easy to use and learn
	#

	use TinyFramework\Application as App;
	use TinyFramework\Service;

	App::init(function() {
		App::compute(function($controller, $action, $params) {
			Service::Router()->add($controller, $action, '/{&lang}/'.$params['rewrite']);
		});
		App::beforeController(function($route) {
			Service::Intl()->setLang($route->params['_lang']);
			//Function::logAuto(0, 'Access to '.$route->getUrl());
		});
		App::controller('home', 'index', function() {
			Service::View(['articles' => Service::Model()->Articles->findAll(['limit' => 5])]);
		});
		App::controller('home', 'rss', function($var) {
			Service::Model()->has($var) ?
				Service::View(['rss' => Service::Rss(Service::Model()->$var->findAll())]) :
				Service::Response()->redirect(Service::Error()->getUrl(404));
		}, ['rewrite' => Service::Intl('rss')]);
		App::controller('home', 'connect', function() {
			($user = Service::Auth()->connect(Service::Request()->post['pseudo'], Service::Request()->post['pwd'])) ?
				Service::Response()->redirect(Service::Router()->getUrl('compte', 'index')) :
				Service::View(['error' => 'connection failed']);
		});
		App::controller('compte', 'index', function() {
			Service::View(['user' => Service::Auth()->user]);
		}, ['rewrite' => Service::Intl('mon-compte')]);
		// Function::add('logAuto', function($text) {
		// 	Service::Log(0, 'Log auto : '.$text);
		// });
	})->run();

	App::run(function() {
		App::controller('config', function() {
			App::action('index', function() {
				Service::View(Service::Model()->Config->findAll());
			});
		});
	});