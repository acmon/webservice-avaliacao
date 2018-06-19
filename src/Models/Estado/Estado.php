<?php

namespace Src\Models\Estado;

use Src\Models\BaseModel as BaseModel;

use Exception;

class Estado extends BaseModel {

	public function definirCollection()
	{
		return 'estados';
	}

	public function cadastrar($dados)
	{
		$nome = filter_var($dados['nome'], FILTER_SANITIZE_STRING);
		$sigla = filter_var($dados['sigla'], FILTER_SANITIZE_STRING);

		$documento = ['nome' => $nome, 'sigla' => $sigla];

		$this->validarCadastro($documento);

		$retorno = parent::cadastrar($documento);

	    return $retorno;
	}

	protected function validarCadastro($dados) {
		
		$this->validarSigla($dados['sigla']);
		
	}

	private function validarSigla($sigla) {
		
		if(strlen($sigla) > 2){
			throw new Exception('A sigla informada possui mais que 2 caracteres');
		}
		
	}

	public function alterar($dados)
	{
		$nome = filter_var($dados['nome'], FILTER_SANITIZE_STRING);
		$sigla = filter_var($dados['sigla'], FILTER_SANITIZE_STRING);
		
		$documento = ['nome' => $nome, 'sigla' => $sigla];

		$this->validarAlteracao($documento);

		$retorno = parent::alterar($dados['id'], $documento);

		return $retorno;
	}

	protected function validarAlteracao($dados) {
		
		$this->validarSigla($dados['sigla']);
		
	}

}