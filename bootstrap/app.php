<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

try{
	$pdo = new PDO('mysql:dbname=db_allweknow; dbhost=10.15.3.183', 'devsisi', 'indonesiatujuhbelas');
}
catch (PDOException $e){
	die("Database connection problem");
}

$app = new Slim\App([

	'settings' => [

		'displayErrorDetails' => true,

	]

]);

$container = $app->getContainer();

// load view
$container['view'] = function ($container) {
	$view = new \Slim\Views\Twig(__DIR__ . '/../resources/views',[

		'cache' => false,

	]);

	$view->addExtension(new Slim\Views\TwigExtension(

		$container->router,
		$container->request->getUri()

	));
	return $view;
};

// load controller
$container['HomeController'] = function ($container) {
	return new \App\Controllers\HomeController($container);
};

$container['dashboardControl'] = function ($container) {
	return new \App\Controllers\dashboardControl($container);
};

// controller settings
	// Menu
	$container['generalControl'] = function ($container) {
		return new \App\Controllers\generalControl($container);
	};

	// Headline
	$container['headlineControl'] = function ($container) {
		return new \App\Controllers\headlineControl($container);
	};
 
$container['myprofile'] = function ($container){
	return new \App\Controllers\myprofile($container);
};

$container['UserAccount'] = function ($container){
	return new \App\Controllers\UserAccount($container);
};

$container['masterAuth'] = function ($container){
	return new \App\Controllers\masterAuth($container);
};

$container['categoryControl'] = function ($container){
	return new \App\Controllers\categoryControl($container);
};

require __DIR__ . '/../app/routes.php';