<?php

namespace Src\http\Middleware\Cidade;

class ExclusaoMiddleware {

	public function __invoke($request, $response, $next)
	{
		$cidade = $request->getParsedBody();
		
		if (!isset($cidade['id']) || $cidade['id'] === '') {
			return $response->withStatus(400)->write("Não foi possível realizar a operação."
													."\nDetalhes: O id não foi informado");
		}

		$response = $next($request, $response);

		return $response;
	}
}
