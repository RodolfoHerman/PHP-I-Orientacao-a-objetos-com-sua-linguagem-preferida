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

		$categoria->setId($produto_array['categoria_id']);
		$categoria->setNome($produto_array['categoria_nome']);

		$produto->setId($produto_array['id']);
		$produto->setNome($produto_array['nome']);
		$produto->setPreco($produto_array['preco']);
		$produto->setDescricao($produto_array['descricao']);
		$produto->setCategoria($categoria);
		$produto->setUsado($produto_array['usado']);

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

	$categoria->setId($produto_array['categoria_id']);

	$produto->setId($produto_array['id']);
	$produto->setNome($produto_array['nome']);
	$produto->setPreco($produto_array['preco']);
	$produto->setDescricao($produto_array['descricao']);
	$produto->setCategoria($categoria);
	$produto->setUsado($produto_array['usado']);

	return $produto;
}

function alteraProduto($con, Produto $produto) {

	$nome = $con->real_escape_string($produto->getNome());
	$preco = $con->real_escape_string($produto->getPreco());
	$descricao = $con->real_escape_string($produto->getDescricao());

	$query = "UPDATE produtos SET nome = '{$nome}', preco = {$preco}, descricao = '{$descricao}', categoria_id = '{$produto->cgetCtegoria()->getId()}', usado = {$produto->getUsado()} WHERE id = '{$produto->getId()}'";
	return $con->query($query);
}

function insereProduto($con, Produto $produto) {
	
	$nome = $con->real_escape_string($produto->getNome());
	$preco = $con->real_escape_string($produto->getPreco());
	$descricao = $con->real_escape_string($produto->descricao);

	$query = "INSERT INTO produtos (nome, preco, descricao, categoria_id, usado) VALUES ('{$nome}', {$preco}, '{$descricao}', {$produto->getCategoria()->getId()}, {$produto->getUsado()})";
	return $con->query($query);
}

function removeProduto($con, $id) {
	$query = "DELETE FROM produtos WHERE id = {$id}";
	$con->query($query);
}