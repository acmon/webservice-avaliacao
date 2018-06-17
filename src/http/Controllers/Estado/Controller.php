<?php

namespace Src\http\Controllers\Estado;

use Src\http\Controllers\BaseController as BaseController;

//#TODO - isolar avaliacao.estados
class Controller extends BaseController {

	public function buscar() 
	{
		try {
			$query = new \MongoDB\Driver\Query([], ['sort' => ['nome' => 1]]);
			$estados = $this->db->executeQuery("avaliacao.estados", $query);

			return $estados;

		} catch (MongoDB\Driver\Exception\Exception $e) {
			
			throw new Exception("Não foi possível buscar os estados \n Detalhes: ".$e);

		}
	}

	public function carregar($id)
	{
		try {
			$query = new \MongoDB\Driver\Query(['_id' => new \MongoDB\BSON\ObjectId($id)], ['limit' => 1]);

			return $this->db->executeQuery("avaliacao.estados", $query)->toArray()[0];

		} catch (MongoDB\Driver\Exception\Exception $e) {
     		
     		throw new Exception("Não foi possível carregar o estado \n Detalhes: ".$e);

		}
	}

	public function cadastrar($dados)
	{
		try {
			#TODO - validar cadastro de estado (sigla e nome informados)
		//- created at
		//- isolar avaliacao.estados
			$nome = filter_var($dados['nome'], FILTER_SANITIZE_STRING);
			$sigla = filter_var($dados['sigla'], FILTER_SANITIZE_STRING);

    		$bulk = new \MongoDB\Driver\BulkWrite;           

    		$doc = ['nome' => $nome, 'sigla' => $sigla];       

		    $bulk->insert($doc);

		    return $this->db->executeBulkWrite('avaliacao.estados', $bulk);

		} catch (MongoDB\Driver\Exception\Exception $e) {
     		
     		throw new Exception("Não foi possível cadastrar o estado \n Detalhes: ".$e);

		}
	}

	public function alterar($dados)
	{
		#TODO - validar alteração de estado (sigla e nome informados)
		#- Updated at		
		try {
			$bulk = new \MongoDB\Driver\BulkWrite;

			$filtro = ['_id' => new \MongoDB\BSON\ObjectId($dados['id'])];

			$nome = filter_var($dados['nome'], FILTER_SANITIZE_STRING);
			$sigla = filter_var($dados['sigla'], FILTER_SANITIZE_STRING);

			$doc = ['nome' => $nome, 'sigla' => $sigla];

			$bulk->update($filtro, $doc, ['multi' => false, 'upsert' => false]);

			return $this->db->executeBulkWrite('avaliacao.estados', $bulk);

		} catch (MongoDB\Driver\Exception\Exception $e) {
     		
     		throw new Exception("Não foi possível excluir o estado \n Detalhes: ".$e);

		}
	}

	public function excluir($id)
	{
		#TODO - validar exclusão (recebeu id)
		#- confirmação de exclusão
		try {
    		$bulk = new \MongoDB\Driver\BulkWrite;

			$filtro = ['_id' => new \MongoDB\BSON\ObjectId($id)];
			$bulk->delete($filtro);

			return $this->db->executeBulkWrite('avaliacao.estados', $bulk);

		} catch (MongoDB\Driver\Exception\Exception $e) {

			throw new Exception("Não foi possível excluir o estado \n Detalhes: ".$e);

		}
	}

}