<?php

namespace Src\http\Controllers\Cidade;

use Src\http\Controllers\BaseController as BaseController;
use Src\Models\Cidade\Cidade as Cidade;

class Controller extends BaseController {

	public function definirModel() {

		return new Cidade($this->container);

	}

	public function index($request, $response)
	{
		return parent::buscar($request, $response);
	}

	public function store($request, $response)
	{
		return parent::cadastrar($request, $response);
	}

	public function update($request, $response)
	{
		return parent::alterar($request, $response);
	}

	public function delete($request, $response)
	{
		return parent::excluir($request, $response);
	}


}