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

	public function buscar() 
	{
		return $this->model->buscar();
	}

	public function carregar($id)
	{
		return $this->model->carregar($id);
	}

	public function cadastrar($dados)
	{
		return $this->model->cadastrar($dados);
	}

	public function alterar($dados)
	{
		return $this->model->alterar($dados);
	}

	public function excluir($id)
	{
		return $this->model->excluir($id);
	}

}
	