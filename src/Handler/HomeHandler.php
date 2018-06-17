<?php

namespace Src\Handler;

use Src\Handler\Handler as Handler;

class HomeHandler extends Handler {

	public function index($request, $response)
	{
		$retorno = $this->view->render($response, 'home.phtml');

		return $retorno;
	}

}