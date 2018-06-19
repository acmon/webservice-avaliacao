<?php

namespace Src\http\Middleware\Estado;

class ExclusaoMiddleware {

	public function __invoke($request, $response, $next)
	{
		$estado = $request->getParsedBody();
		
		if (!isset($estado['id']) || $estado['id'] === '') {
			return $response->withStatus(400)->write("Não foi possível realizar a operação."
													."\nDetalhes: O id não foi informado");
		}

		$response = $next($request, $response);

		return $response;
	}
}
