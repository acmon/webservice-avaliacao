<?php

namespace Src\http\Controllers;

use Exception;

class BaseController {

	function __construct($container)
	{
		$this->container = $container;

		$this->model = $this->definirModel();
	}

	public function definirModel()
	{
		throw new Exception('Método obrigatório não implementado');
	}

	public function buscar($request, $response)
	{
		try
		{
			$filtro = $request->getParams();

			$retorno = $this->model->buscar($filtro);

			return $response->withJson($retorno, 200, JSON_UNESCAPED_UNICODE);

		} catch (Exception $e) {
			return $response->withStatus(400)->write("Não foi possível realizar a busca. \n Detalhes: ".$e->getMessage());
		}
	}

	public function carregar($id)
	{
		try
		{
			return $this->model->carregar($id);

		} catch (Exception $e) {
			return $response->withStatus(400)->write("Não foi possível carregar. \n Detalhes: ".$e->getMessage());
		}
	}

	public function cadastrar($request, $response)
	{
		try 
		{
			$dados = $request->getParsedBody();

			$this->model->cadastrar($dados);

			return $response->withJson([
				"msg" => "Cadastro realizado com sucesso"
			]);
			
		} catch (Exception $e) {
			return $response->withStatus(400)->write("Não foi possível realizar o cadastro. \n Detalhes: ".$e->getMessage());
		}
	}

	public function alterar($request, $response)
	{	
		try 
		{
			$dados = $request->getParsedBody();

			$this->model->alterar($dados);

			return $response->withJson([
				"msg" => "Alteração realizada com sucesso"
			]);

		} catch (Exception $e) {
			return $response->withStatus(400)->write("Não foi possível realizar a alteração. \n Detalhes: ".$e->getMessage());
		}
		
	}

	public function excluir($request, $response)
	{
		try 
		{
			$dados = $request->getParsedBody();

			$id = $dados['id'];

			$this->model->excluir($id);

			return $response->withJson([
				"msg" => "Exclusão realizada com sucesso"
			]);
		} catch (Exception $e) {
			return $response->withStatus(400)->write("Não foi possível realizar a exclusão. \n Detalhes: ".$e->getMessage());
		}

	}

}
