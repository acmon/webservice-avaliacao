<?php

namespace Src\http\Middleware\Estado;

class CadastroMiddleware {

	public function __invoke($request, $response, $next)
	{
		$estado = $request->getParsedBody();
		
		if (!isset($estado['nome']) || $estado['nome'] === '') {
			return $response->withStatus(400)->write("Não foi possível realizar a operação."
													."\nDetalhes: O nome não foi informado");
		}

		if (!isset($estado['sigla']) || $estado['sigla'] === '') {
			return $response->withStatus(400)->write("Não foi possível realizar a operação."
													."\nDetalhes: A sigla não foi informado");
		}

		$response = $next($request, $response);

		return $response;
	}
}
