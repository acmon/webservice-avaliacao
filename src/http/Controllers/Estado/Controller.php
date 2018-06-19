<?php

namespace Src\http\Controllers\Estado;

use Src\http\Controllers\BaseController as BaseController;
use Src\Models\Estado\Estado as Estado;

class Controller extends BaseController {

	public function definirModel() 
	{
		return new Estado($this->container);
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
