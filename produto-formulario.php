<?php 
	require_once("banco-categoria.php");
	require_once("logica-usuario.php");
	require_once("class/Produto.php");
	require_once("class/Categoria.php");
	require_once("cabecalho.php"); 

	verificaUsuario();

	$categoria_nova = new Categoria();
	$categoria_nova->id = 1;

	$produto = new Produto();

	$produto->nome = "";
	$produto->preco = "";
	$produto->descricao = "";
	$produto->categoria = $categoria_nova;
	$produto->usado = "";	

?>

<h1>Formulário de cadastro</h1>

<form action="adiciona-produto.php" method="POST">
	
		<?php include("formulario-produto-base.php"); ?>

		<tr>
			<td><input type="submit" class="btn btn-primary" value="Cadastrar" /></td>
		</tr>
	</table>
</form>


<?php require_once("rodape.php"); ?>