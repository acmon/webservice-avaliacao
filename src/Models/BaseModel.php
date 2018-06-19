<?php

namespace Src\Models;

use Exception;

class BaseModel {

	protected $collection = '';
	protected $dbCollection = '';
	protected $identificadoresExternos = [];

	function __construct($container)
	{
		$this->container = $container;
		$this->collection = $this->definirCollection();
		$this->identificadoresExternos = $this->definirIdentificadoresExternos();
		$this->dbCollection = $this->settings['db']['name'].'.'.$this->collection;
	}

	function __get($property)
	{
		if($this->container->{$property}) {
			return $this->container->{$property};
		}
	}

	protected function definirCollection()
	{
		throw new Exception('Método obrigatório');
	}

	protected function definirIdentificadoresExternos()
	{
		return [];
	}

	public function buscar($filtroRaw) 
	{
		$filtro = $this->montarFiltroBusca($filtroRaw);
		$ordenacao = $this->definirOrdenacao($filtroRaw);

		try {
			$query = new \MongoDB\Driver\Query($filtro, ['sort' => [$ordenacao => 1]]);
			$itensBusca = $this->db->executeQuery($this->dbCollection, $query);

			$retorno = [];

			foreach ($itensBusca as $item) {
				array_push($retorno, $item);
			}

			return $retorno;

		} catch (\MongoDB\Driver\Exception\Exception $e) {
			
			throw new Exception($e->getMessage());

		}
	}

	protected function definirOrdenacao ($filtroRaw)
	{
		if($filtroRaw['ordenacao']){
			$ordenacao = $filtroRaw['ordenacao'];
		} else {
			$ordenacao = 'nome';
		}

		return $ordenacao;
	}

	protected function montarFiltroBusca ($filtroRaw)
	{
		$filtro = [];

		foreach ($filtroRaw as $key => $value) {
			
			if($value[$key] !== '' && $key !== 'ordenacao') {

				if ($key === "id") {
				
					$filtro['_'.$key] = new \MongoDB\BSON\ObjectId($value);
				
				} else if (in_array($key, $this->identificadoresExternos)) {

					$filtro[$key] = new \MongoDB\BSON\ObjectId($value);

				}else {

					$filtro[$key] = new \MongoDB\BSON\Regex($value,'i');
				}
			}
		}

		return $filtro;
	}

	public function carregar($id)
	{
		try {
			$query = new \MongoDB\Driver\Query(['_id' => new \MongoDB\BSON\ObjectId($id)], ['limit' => 1]);

			return $this->db->executeQuery($this->dbCollection, $query)->toArray()[0];

		} catch (\MongoDB\Driver\Exception\Exception $e) {
			
			throw new Exception($e->getMessage());

		}
	}

	public function cadastrar($documento)
	{
		try {
			$documento['criado_em'] = date("d/m/Y H:i:s");
			$documento['atualizado_em'] = date("d/m/Y H:i:s");

			$documento = $this->documentoParaLower($documento);

			$bulk = new \MongoDB\Driver\BulkWrite;           

			$bulk->insert($documento);

			return $this->db->executeBulkWrite($this->dbCollection, $bulk);

		} catch (\MongoDB\Driver\Exception\Exception $e) {
			
			throw new Exception($e->getMessage());

		}
	}

	public function alterar($id, $dados)
	{
		try {
			$filtro = ['_id' => new \MongoDB\BSON\ObjectId($id)];
			$dados['atualizado_em'] = date("d/m/Y H:i:s");

			$dados = $this->documentoParaLower($dados);

			$documento['$set'] = $dados;

			$bulk = new \MongoDB\Driver\BulkWrite;

			$bulk->update($filtro, $documento, ['multi' => false, 'upsert' => false]);

			$result = $this->db->executeBulkWrite($this->dbCollection, $bulk);

			if($result->getModifiedCount() == 0) {
				throw new Exception("O id informado não correspondeu a nenhum item cadastrado");
			}

			return $result;

		} catch (\MongoDB\Driver\Exception\Exception $e) {
			
			throw new Exception($e->getMessage());

		}
	}

	private function documentoParaLower($doc) {

		$documento = [];

		foreach ($doc as $key => $value) {

			if (in_array($key, $this->identificadoresExternos)) {

				$documento[$key] = $value;
			
			} else if($key !== "id") {

				$documento[$key] = strtolower($value);

			}
		}

		return $documento;

	}

	public function excluir($id)
	{
		try {
			$bulk = new \MongoDB\Driver\BulkWrite;

			$filtro = ['_id' => new \MongoDB\BSON\ObjectId($id)];

			$bulk->delete($filtro);

			$result = $this->db->executeBulkWrite($this->dbCollection, $bulk);

			if($result->getDeletedCount() == 0) {
				throw new Exception("O id informado não correspondeu a nenhum item cadastrado");
			}

			return $result;

		} catch (\MongoDB\Driver\Exception\Exception $e) {

			throw new Exception($e->getMessage());

		}
	}
}