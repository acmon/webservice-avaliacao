<?php

namespace Src\Action;

use Src\Action\Action as Action;

class HomeAction extends Action {

	public function index($request, $response)
	{
		$retorno = $this->view->render($response, 'home.phtml');

		return $retorno;
	}

}