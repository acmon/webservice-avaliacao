<?php

$app->get('/', 'Src\Action\HomeAction:index');

$app->group('/estado', function() {

	$this->get('', 'Src\Action\Estado\EstadoAction:index');

	$this->get('/cadastrar', 'Src\Action\Estado\EstadoAction:novo');
	$this->post('/cadastrar', 'Src\Action\Estado\EstadoAction:store');
	
	$this->get('/{id}/alterar', 'Src\Action\Estado\EstadoAction:alterar');
	$this->post('/{id}/alterar', 'Src\Action\Estado\EstadoAction:update');
	
	$this->get('/{id}/excluir', 'Src\Action\Estado\EstadoAction:delete');

});
