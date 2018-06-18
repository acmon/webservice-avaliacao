<?php

namespace Src\Handler\Estado;

use Src\http\Controllers\Estado\Controller as EstadoController;
use Src\Handler\Handler as Handler;

class EstadoHandler extends Handler {

	function __construct($container)
	{
		parent::__construct($container);

		$this->estadoController = new EstadoController($container);
	}

	public function index($request, $response)
	{
		$filtro = $request->getParams();
		//#TODO - filtrar e ordenar	
		$retorno['estados'] = $this->estadoController->buscar($filtro);

		return $this->view->render($response, 'estado/listaEstados.phtml', $retorno);
	}

	public function novo($request, $response)
	{
		return $this->view->render($response, 'estado/cadastraEstado.phtml');
	}

	public function store($request, $response)
	{
		$dados = $request->getParsedBody();

		$retorno = $this->estadoController->cadastrar($dados);

		return $response->withRedirect('/estado');
	}

	public function alterar($request, $response)
	{
		#TODO - validar abertura de tela de alterar (recebeu id)
		$id = $request->getAttribute('id');

		$retorno = array();

		$retorno['estado'] = $this->estadoController->carregar($id);

		return $this->view->render($response, 'estado/alteraEstado.phtml', $retorno);
	}

	public function update($request, $response)
	{
		$dados = $request->getParsedBody();
		$dados['id'] = $request->getAttribute('id');

		$retorno = $this->estadoController->alterar($dados);
		
		return $response->withRedirect('/estado');
		
	}

	public function delete($request, $response)
	{
		$id = $request->getAttribute('id');

		$retorno = $this->estadoController->excluir($id);

		return $response->withRedirect('/estado');
	}

}