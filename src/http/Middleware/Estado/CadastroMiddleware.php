<?php

namespace Src\http\Middleware\Estado;

class CadastroMiddleware {

	public function __invoke($request, $response, $next)
	{
		$estado = $request->getParsedBody();
		
		if (!isset($estado['nome']) || $estado['nome'] === '') {
			return $response->withStatus(400)->write("O nome não foi informado");
		}

		if (!isset($estado['sigla']) || $estado['sigla'] === '') {
			return $response->withStatus(400)->write("A sigla não foi informada");
		}

		$response = $next($request, $response);

		return $response;
	}

}