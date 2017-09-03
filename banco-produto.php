<?php
require_once("conecta.php");

function listaProdutos($con) {

	$query = "SELECT p.*, c.nome as categoria_nome FROM produtos p JOIN categorias c ON p.categoria_id = c.id";

	$resultado = $con->query($query);
	
	$produtos = array();

	while($produto = mysqli_fetch_assoc($resultado)) {
		array_push($produtos, $produto);
	}

	return $produtos;
}

function buscaProduto($con, $id) {
	$query = "SELECT * FROM produtos WHERE id = {$id}";
	$resultado = $con->query($query);
	return mysqli_fetch_assoc($resultado);
}

function alteraProduto($con, $produto) {

	$nome = $con->real_escape_string($produto->nome);
	$preco = $con->real_escape_string($produto->preco);
	$descricao = $con->real_escape_string($produto->descricao);

	$query = "UPDATE produtos SET nome = '{$nome}', preco = {$preco}, descricao = '{$descricao}', categoria_id = '{$produto->categoria_id}', usado = {$produto->usado} WHERE id = '{$produto->id}'";
	return $con->query($query);
}

function insereProduto($con, $produto) {
	
	$nome = $con->real_escape_string($produto->nome);
	$preco = $con->real_escape_string($produto->preco);
	$descricao = $con->real_escape_string($produto->descricao);

	$query = "INSERT INTO produtos (nome, preco, descricao, categoria_id, usado) VALUES ('{$nome}', {$preco}, '{$descricao}', {$produto->categoria_id}, {$produto->usado})";
	return $con->query($query);
}

function removeProduto($con, $id) {
	$query = "DELETE FROM produtos WHERE id = {$id}";
	$con->query($query);
}