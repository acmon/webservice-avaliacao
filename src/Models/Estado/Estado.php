<?php

namespace Src\Models\Estado;

use Src\Models\BaseModel as BaseModel;
use Src\Models\Cidade\Cidade as Cidade;

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

	public function excluir($id)
	{
		$this->validarExclusao($id);

		return parent::excluir($id);
	}

	protected function validarAlteracao($dados) {
		
		$this->validarSigla($dados['sigla']);
		
	}

	protected function validarExclusao($id) {
		
		$cidade = new Cidade($this->container);
		$filtroCidade['id_estado'] = $id;

		$retorno = $cidade->buscar($filtroCidade);
		
		if(count($retorno) > 0 ) {
			throw new Exception("O estado possui cidades vinculadas ao mesmo");
			
		}
		
	}

}