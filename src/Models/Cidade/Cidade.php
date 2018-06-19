<?php

namespace Src\Models\Cidade;

use Src\Models\BaseModel as BaseModel;

use Exception;

class Cidade extends BaseModel {

	public function definirCollection()
	{
		return 'cidades';
	}

	public function definirIdentificadoresExternos()
	{
		return ['id_estado'];
	}

	public function cadastrar($dados)
	{
		$nome = filter_var($dados['nome'], FILTER_SANITIZE_STRING);
		$idEstado = filter_var($dados['id_estado'], FILTER_SANITIZE_STRING);
		$idEstado = new \MongoDB\BSON\ObjectId($idEstado);

		$documento = ['nome' => $nome, 'id_estado' => $idEstado];

		$retorno = parent::cadastrar($documento);

	    return $retorno;
	}

	public function alterar($dados)
	{
		$nome = filter_var($dados['nome'], FILTER_SANITIZE_STRING);
		$idEstado = filter_var($dados['id_estado'], FILTER_SANITIZE_STRING);
		$idEstado = new \MongoDB\BSON\ObjectId($idEstado);
		
		$documento = ['nome' => $nome, 'id_estado' => $idEstado];

		$retorno = parent::alterar($dados['id'], $documento);

		return $retorno;
	}

}