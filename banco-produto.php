<?php
require_once("conecta.php");
require_once("class/Produto.php");
require_once("class/Categoria.php");

function listaProdutos($con) {

	$query = "SELECT p.*, c.nome as categoria_nome FROM produtos p JOIN categorias c ON p.categoria_id = c.id";

	$resultado = $con->query($query);
	
	$produtos = array();

	while($produto_array = mysqli_fetch_assoc($resultado)) {
		
		$produto = new Produto();
		$categoria = new Categoria();

		$categoria->id = $produto_array['categoria_id'];
		$categoria->nome = $produto_array['categoria_nome'];

		$produto->id = $produto_array['id'];
		$produto->nome = $produto_array['nome'];
		$produto->preco = $produto_array['preco'];
		$produto->descricao = $produto_array['descricao'];
		$produto->categoria = $categoria;
		$produto->usado = $produto_array['usado'];	

		array_push($produtos, $produto);
	}

	return $produtos;
}

function buscaProduto($con, $id) {
	$query = "SELECT * FROM produtos WHERE id = {$id}";
	$resultado = $con->query($query);

	$produto_array = mysqli_fetch_assoc($resultado);

	$produto = new Produto();
	$categoria = new Categoria();

	$categoria->id = $produto_array['categoria_id'];

	$produto->id = $produto_array['id'];
	$produto->nome = $produto_array['nome'];
	$produto->preco = $produto_array['preco'];
	$produto->descricao = $produto_array['descricao'];
	$produto->categoria = $categoria;
	$produto->usado = $produto_array['usado'];


	return $produto;
}

function alteraProduto($con, Produto $produto) {

	$nome = $con->real_escape_string($produto->nome);
	$preco = $con->real_escape_string($produto->preco);
	$descricao = $con->real_escape_string($produto->descricao);

	$query = "UPDATE produtos SET nome = '{$nome}', preco = {$preco}, descricao = '{$descricao}', categoria_id = '{$produto->categoria->id}', usado = {$produto->usado} WHERE id = '{$produto->id}'";
	return $con->query($query);
}

function insereProduto($con, Produto $produto) {
	
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