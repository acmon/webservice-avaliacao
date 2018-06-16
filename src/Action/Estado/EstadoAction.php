<?php

namespace Src\Action\Estado;

use Src\Action\Action as Action;

class EstadoAction extends Action {

	public function index($request, $response)
	{
		#TODO - filtrar
		$estados = $this->db->prepare("SELECT est_id, est_nome, est_sigla FROM estados ORDER BY est_nome ASC");

		$estados->execute();

		$retorno = array();

		if ($estados->rowCount() > 0) {
			$retorno['estados'] = $estados->fetchAll(\PDO::FETCH_OBJ);
		}

		return $this->view->render($response, 'estado/listaEstados.phtml', $retorno);
	}

	public function novo($request, $response)
	{

		$retorno = $this->view->render($response, 'estado/cadastraEstado.phtml');

		return $retorno;
	}

	public function store($request, $response)
	{
		#TODO - validar cadastro de estado (sigla e nome informados)
		#- created at

		$dados = $request->getParsedBody();

		$nome = filter_var($dados['nome'], FILTER_SANITIZE_STRING);
		$sigla = filter_var($dados['sigla'], FILTER_SANITIZE_STRING);

		$cadastro = $this->db->prepare('INSERT INTO estados SET est_nome = ?, est_sigla = ?');
		$cadastro->execute(array($nome, $sigla));

		return $response->withRedirect('/estado');

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
		$id = $request->getAttribute('id');

		$excluir = $this->db->prepare('DELETE from estados where est_id = ?');
		$excluir->execute(array($id));

		return $response->withRedirect('/estado');
	}

}