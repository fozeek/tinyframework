<?php

	#
	#	Multiple apps processing
	#	Simple features
	#	Simple APIs for component developpement
	#	Fast PHP framework
	#	Easy to use and learn
	#

	use TinyFramework\App;
	use TinyFramework\Component;

	App::run(function() {
		App::controller('home', 'index', function() {
			return Component::View(['articles' => Component::Model->Articles->findAll(['limit' => 5])]);
		});
		App::controller('home', 'rss', function($var) {
			if(Component::Model::has($var)) {
				return Component::Rss(Component::Model->$var->findAll())
			}
			else {
				return Component::Response->redirect(Component::Error->getUrl(404));
			}
		});
		App::controller('home', 'connect', function() {
			$data = Component::Request->data;
			if($user = Component::Auth->connect($data['pseudo'], $data['pwd'])) {
				return Component::Response->redirect(Component::Router->getUrl('compte', 'index'));
			}
			else {
				return Component::View(['error' => 'connection failed']);
			}
		});
		App::controller('compte', 'index', function() {
			$user = Component:::Auth->user;
		});
	})

	App::run(function() {

	});