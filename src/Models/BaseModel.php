<?php

namespace Src\Models;

class BaseModel {

	protected $collection = '';
	protected $dbCollection = '';

	function __construct($container)
	{
		$this->container = $container;
		$this->collection = $this->definirCollection();
		$this->dbCollection = $this->settings['db']['name'].'.'.$this->collection;
	}

	function __get($property)
	{
		if($this->container->{$property}) {
			return $this->container->{$property};
		}
	}

	public function definirCollection()
	{
		throw new Exception('Método obrigatório');
	}

	public function buscar() 
	{
		try {
			$query = new \MongoDB\Driver\Query([], ['sort' => ['nome' => 1]]);
			$retorno = $this->db->executeQuery($this->dbCollection, $query);

			return $retorno;

		} catch (MongoDB\Driver\Exception\Exception $e) {
			
			throw new Exception("Não foi possível buscar \n Detalhes: ".$e);

		}
	}

	public function carregar($id)
	{
		try {
			$query = new \MongoDB\Driver\Query(['_id' => new \MongoDB\BSON\ObjectId($id)], ['limit' => 1]);

			return $this->db->executeQuery($this->dbCollection, $query)->toArray()[0];

		} catch (MongoDB\Driver\Exception\Exception $e) {
     		
     		throw new Exception("Não foi possível carregar \n Detalhes: ".$e);

		}
	}

	public function cadastrar($documento)
	{
		try {
			$documento['criado_em'] = date("d/m/Y H:i:s");
			$documento['atualizado_em'] = date("d/m/Y H:i:s");

    		$bulk = new \MongoDB\Driver\BulkWrite;           

		    $bulk->insert($documento);

		    return $this->db->executeBulkWrite($this->dbCollection, $bulk);

		} catch (MongoDB\Driver\Exception\Exception $e) {
     		
     		throw new Exception("Não foi possível cadastrar. \n Detalhes: ".$e);

		}
	}

	public function alterar($id, $documento)
	{
		#TODO - validar alteração de estado (sigla e nome informados)
		try {
			$filtro = ['_id' => new \MongoDB\BSON\ObjectId($id)];
			$documento['atualizado_em'] = date("d/m/Y H:i:s");

			$bulk = new \MongoDB\Driver\BulkWrite;

			$bulk->update($filtro, $documento, ['multi' => false, 'upsert' => false]);

			return $this->db->executeBulkWrite($this->dbCollection, $bulk);

		} catch (MongoDB\Driver\Exception\Exception $e) {
     		
     		throw new Exception("Não foi possível excluir. \n Detalhes: ".$e);

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

			return $this->db->executeBulkWrite($this->dbCollection, $bulk);

		} catch (MongoDB\Driver\Exception\Exception $e) {

			throw new Exception("Não foi possível excluir \n Detalhes: ".$e);

		}
	}

}