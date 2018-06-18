<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->group('/api/v1', function(){

	$this->group('/estado', function() {

		$this->get('', 'Src\http\Controllers\Estado\Controller:index');
		$this->post('', 'Src\http\Controllers\Estado\Controller:store');
		$this->put('', 'Src\http\Controllers\Estado\Controller:update');
		$this->delete('', 'Src\http\Controllers\Estado\Controller:delete');

	});

	$this->group('/cidade', function() {

		$this->get('', 'Src\http\Controllers\Cidade\Controller:index');
		$this->post('', 'Src\http\Controllers\Cidade\Controller:store');
		$this->put('', 'Src\http\Controllers\Cidade\Controller:update');
		$this->delete('', 'Src\http\Controllers\Cidade\Controller:delete');

	});

});

