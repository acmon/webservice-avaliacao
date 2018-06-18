<?php

namespace Src\Models\Estado;

use Src\Models\BaseModel as BaseModel;

class Estado extends BaseModel {

	public function definirCollection()
	{
		return 'estados';
	}

	public function cadastrar($dados)
	{
		#TODO - validar cadastro de estado (sigla e nome informados)
		$nome = filter_var($dados['nome'], FILTER_SANITIZE_STRING);
		$sigla = filter_var($dados['sigla'], FILTER_SANITIZE_STRING);

		$documento = ['nome' => $nome, 'sigla' => $sigla];

		$retorno = parent::cadastrar($documento);

	    return $retorno;
	}

	public function alterar($dados)
	{
		#TODO - validar alteração de estado (sigla e nome informados)
		$nome = filter_var($dados['nome'], FILTER_SANITIZE_STRING);
		$sigla = filter_var($dados['sigla'], FILTER_SANITIZE_STRING);
		$criado_em = filter_var($dados['criado_em'], FILTER_SANITIZE_STRING);

		$documento = ['nome' => $nome, 'sigla' => $sigla, 'criado_em' => $criado_em];

		$retorno = parent::alterar($dados['id'], $documento);

		return $retorno;
	}

}