<?php

	/*
	 *		Bootstrap for all Applications
	 *
	 */

	use TinyFramework\Service;

	Service::add([
		// 'View' => new TinyFramework\View;
		// 'Auth' => new TinyFramework\Auth;
		// 'Session' => new TinyFramework\Session;
		'Request' => new TinyFramework\Service\Request,
		// 'Model' => new TinyFramework\Model;
		// 'Rss' => new TinyFramework\Rss;
		// 'Response' => new TinyFramework\Service\Response,
		// 'Intl' => new TinyFramework\Intl;
		// 'Log' => new TinyFramework\Log;
	]);

	// Service::View->setTplEngine([new TplEngine\TplEngine(), 'fromFile']); // callback : function, class+method(static or not), anonim function
	// Service::View->setViewsPath('views/{application}/{controller}/{action}.tpl');


	// Service::Auth->setModel('User');
	// Service::Auth->setAttributs(['assing' => 'pseudo', 'check' => 'pwd']);


	// Service::Router->setLoadUrl('/{app}/{&lang}/{controller}/{action}/{params}');
	// Service::Router->setDefaultApp(0);
	// Service::Router->setDefaultController('home');
	// Service::Router->setDefaultAction('index');
