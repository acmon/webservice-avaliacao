<?php

namespace Src\Action\Estado;

use Src\Action\Action as Action;

class EstadoAction extends Action {

	public function index($request, $response)
	{
		//#TODO - filtrar e ordenar
		//- isolar avaliacao.estados
		try {
			$query = new \MongoDB\Driver\Query([], ['sort' => ['nome' => 1]]);

			$estados = $this->db->executeQuery("avaliacao.estados", $query);  
			
			$retorno = array();
	
			$retorno['estados'] = $estados;

			return $this->view->render($response, 'estado/listaEstados.phtml', $retorno);	

		} catch (MongoDB\Driver\Exception\Exception $e) {
			
			throw new Exception("Não foi possível buscar os estados \n Detalhes: ".$e);

		}		
	}

	public function novo($request, $response)
	{

		$retorno = $this->view->render($response, 'estado/cadastraEstado.phtml');

		return $retorno;
	}

	public function store($request, $response)
	{
		#TODO - validar cadastro de estado (sigla e nome informados)
		//- created at
		//- isolar avaliacao.estados

		$dados = $request->getParsedBody();

		$nome = filter_var($dados['nome'], FILTER_SANITIZE_STRING);
		$sigla = filter_var($dados['sigla'], FILTER_SANITIZE_STRING);

		try {
    		$bulk = new \MongoDB\Driver\BulkWrite;           

    		$doc = ['nome' => $nome, 'sigla' => $sigla];       

		    $bulk->insert($doc);

		    $this->db->executeBulkWrite('avaliacao.estados', $bulk);
		    
			return $response->withRedirect('/estado');

		} catch (MongoDB\Driver\Exception\Exception $e) {
     		
     		throw new Exception("Não foi possível cadastrar o estado \n Detalhes: ".$e);

		}

	}

	public function alterar($request, $response)
	{
		#TODO - validar abertura de tela de alterar (recebeu id)

		$id = $request->getAttribute('id');

		$estado = $this->db->prepare('SELECT est_id, est_nome, est_sigla FROM estados where est_id = ?');
		$estado->execute(array($id));

		if ($estado->rowCount() == 1) {
			$retorno['estado'] = $estado->fetch(\PDO::FETCH_OBJ);
		}

		return $this->view->render($response, 'estado/alteraEstado.phtml', $retorno);
	}

	public function update($request, $response)
	{
		#TODO - validar alteração de estado (sigla e nome informados)
		#- Updated at
		$dados = $request->getParsedBody();

		$id = $request->getAttribute('id');
		$nome = filter_var($dados['nome'], FILTER_SANITIZE_STRING);
		$sigla = filter_var($dados['sigla'], FILTER_SANITIZE_STRING);

		$cadastro = $this->db->prepare('UPDATE estados SET est_nome = ?, est_sigla = ? WHERE est_id = ?');
		$cadastro->execute(array($nome, $sigla, $id));

		return $response->withRedirect('/estado');

	}

	public function delete($request, $response)
	{
		#TODO - validar exclusão (recebeu id)
		#- confirmação de exclusão
		try {
    		$bulk = new \MongoDB\Driver\BulkWrite;    

			$id = $request->getAttribute('id');

			$filtro = ['_id' => new \MongoDB\BSON\ObjectId($id)];
			$bulk->delete($filtro);

			$this->db->executeBulkWrite('avaliacao.estados', $bulk);

			return $response->withRedirect('/estado');

		} catch (MongoDB\Driver\Exception\Exception $e) {
     		
     		throw new Exception("Não foi possível excluir o estado \n Detalhes: ".$e);

		}
	}

}