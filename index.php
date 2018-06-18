<?php
if (PHP_SAPI == 'cli-server') {
	// To help the built-in PHP dev server, check if the request was actually for
	// something which should probably be served as a static file
	$url  = parse_url($_SERVER['REQUEST_URI']);
	$file = __DIR__ . $url['path'];
	if (is_file($file)) {
		return false;
	}
}

require 'vendor/autoload.php';

session_start();

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Instantiate the app
$settings = require __DIR__ . '/config/settings.php';
$app = new \Slim\App($settings);

$container = $app->getContainer();

$container['view'] = new \Slim\Views\PhpRenderer('resources/views/');

require 'src/http/routes.php';

$container['db'] = function ($c) {

	try {

		$dbSettings = $c['settings']['db'];

	    $mongo = new \MongoDB\Driver\Manager($dbSettings['url']);

	    return $mongo;

	} catch (MongoDB\Driver\Exception\Exception $e) {
	   
	   throw new Exception("Não foi possível conectar com o banco de dados \n Detalhes: ".$e); 

	}
};

$app->run();
