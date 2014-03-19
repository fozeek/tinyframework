<?php

	/*
	 *		Bootstrap for all Applications
	 *
	 */

	use TinyFramework\Component;

	Component::add(
		'View' => new TinyFramework\View;
		'Auth' => new TinyFramework\Auth;
		'Session' => new TinyFramework\Session;
		'Request' => new TinyFramework\Request;
		'Model' => new TinyFramework\Model;
		'Rss' => new TinyFramework\Rss;
		'Response' => new TinyFramework\Response;
	);

	Component::View->setTplEngine([new TplEngine\TplEngine(), 'fromFile']); // callback : function, class+method(static or not), anonim function
	Component::View->setViewsPath('views/{application}/{controller}/{action}.tpl');


	Component::Auth->setModel('User');
	Component::Auth->setAttributs(['assing' => 'pseudo', 'check' => 'pwd']);