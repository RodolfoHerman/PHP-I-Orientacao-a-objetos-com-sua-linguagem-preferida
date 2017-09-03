<?php
require_once("conecta.php");

function listaCategorias($con) {
	$query = "SELECT * from categorias";
	$resultado = $con->query($query);

	$categorias = array();

	while($categoria = mysqli_fetch_assoc($resultado)) {

		array_push($categorias, $categoria);
	}

	return $categorias;
}