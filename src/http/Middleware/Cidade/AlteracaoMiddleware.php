<?php

namespace Src\http\Middleware\Cidade;

class AlteracaoMiddleware {

	public function __invoke($request, $response, $next)
	{
		$cidade = $request->getParsedBody();
		
		if (!isset($cidade['nome']) || $cidade['nome'] === '') {
			return $response->withStatus(400)->write("Não foi possível realizar a operação."
													."\nDetalhes: O nome não foi informado");
		}

		if (!isset($cidade['id_estado']) || $cidade['id_estado'] === '') {
			return $response->withStatus(400)->write("Não foi possível realizar a operação."
													."\nDetalhes: O id do estado não foi informado");
		}

		$response = $next($request, $response);

		return $response;
	}
}
