<?php

$app->get('/', 'Src\Handler\HomeHandler:index');

$app->group('/estado', function() {

	$this->get('', 'Src\Handler\Estado\EstadoHandler:index');

	$this->get('/cadastrar', 'Src\Handler\Estado\EstadoHandler:novo');
	$this->post('/cadastrar', 'Src\Handler\Estado\EstadoHandler:store');
	
	$this->get('/{id}/alterar', 'Src\Handler\Estado\EstadoHandler:alterar');
	$this->post('/{id}/alterar', 'Src\Handler\Estado\EstadoHandler:update');
	
	$this->get('/{id}/excluir', 'Src\Handler\Estado\EstadoHandler:delete');

});
