<?php

require 'vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/config/settings.php';
$app = new \Slim\App($settings);

$container = $app->getContainer();

require 'src/http/routes.php';

$container['db'] = function ($c) {

	try {

		$dbSettings = $c['settings']['db'];

	    $mongo = new \MongoDB\Driver\Manager($dbSettings['url']);

	    return $mongo;

	} catch (\MongoDB\Driver\Exception\Exception $e) {
	   
	   throw new Exception("Não foi possível conectar com o banco de dados \n Detalhes: ".$e); 

	}
};

$app->run();
