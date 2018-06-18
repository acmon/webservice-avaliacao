<?php

namespace Src\http\Controllers;

class BaseController {

	function __construct($container)
	{
		$this->container = $container;

		$this->model = $this->definirModel();
	}

	public function definirModel()
	{
		throw new Exception('Método obrigatório');
	}

	public function buscar($request, $response)
	{
		$filtro = $request->getParams();

		$retorno = $this->model->buscar($filtro);

		return $response->withJson($retorno, 200, JSON_UNESCAPED_UNICODE);
	}

	public function carregar($id)
	{
		return $this->model->carregar($id);
	}

	public function cadastrar($request, $response)
	{
		$dados = $request->getParsedBody();

		$this->model->cadastrar($dados);

		return $response->withJson([
			"msg" => "Cadastro realizado com sucesso"
		]);
	}

	public function alterar($request, $response)
	{	
		$dados = $request->getParsedBody();

		$this->model->alterar($dados);

		return $response->withJson([
			"msg" => "Alteração realizada com sucesso"
		]);
	}

	public function excluir($request, $response)
	{
		$dados = $request->getParsedBody();

		$id = $dados['id'];

		$this->model->excluir($id);

		return $response->withJson([
			"msg" => "Exclusão realizada com sucesso"
		]);

	}

}
	