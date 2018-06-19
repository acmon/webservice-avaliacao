<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->group('/api/v1', function(){

	$this->group('/estado', function() {

		$this->get('', 'Src\http\Controllers\Estado\Controller:index');
		$this->post('', 'Src\http\Controllers\Estado\Controller:store')->add(Src\http\Middleware\Estado\CadastroMiddleware::class);
		$this->put('', 'Src\http\Controllers\Estado\Controller:update')->add(Src\http\Middleware\Estado\AlteracaoMiddleware::class);;
		$this->delete('', 'Src\http\Controllers\Estado\Controller:delete')->add(Src\http\Middleware\Estado\ExclusaoMiddleware::class);;

	});

	$this->group('/cidade', function() {

		$this->get('', 'Src\http\Controllers\Cidade\Controller:index');
		$this->post('', 'Src\http\Controllers\Cidade\Controller:store')->add(Src\http\Middleware\Cidade\CadastroMiddleware::class);
		$this->put('', 'Src\http\Controllers\Cidade\Controller:update')->add(Src\http\Middleware\Cidade\AlteracaoMiddleware::class);
		$this->delete('', 'Src\http\Controllers\Cidade\Controller:delete')->add(Src\http\Middleware\Cidade\ExclusaoMiddleware::class);

	});
});
