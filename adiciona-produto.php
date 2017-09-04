<?php
	require_once("banco-produto.php");
	require_once("logica-usuario.php");
	require_once("class/Produto.php");
	require_once("class/Categoria.php");
	require_once("cabecalho.php");

	verificaUsuario();

	
	$produto = new Produto();
	$categoria = new Categoria();

	$categoria->setId($_POST['categoria_id']);

	$produto->setNome($_POST['nome']);
	$produto->setPreco($_POST['preco']);
	$produto->setDescricao($_POST['descricao']);
	$produto->setCategoria($categoria);
	$produto->setUsado(array_key_exists('usado', $_POST) ? 'true' : 'false');
?>

<?php if(insereProduto($con, $produto)): ?>
	<p class="text-success">
		Produto <?php echo $produto->getNome(); ?> com o valor de R$<?php echo $produto->getPreco(); ?> adicionado com sucesso !!
	</p>	
<?php else: ?>
	<p class="text-danger">
		Produto <?php echo $produto->getNome(); ?> com o valor de R$<?php echo $produto->getPreco(); ?> não foi adicionado. Erro: <?php echo $con->error; ?>
	</p>
<?php endif; ?>


<?php $con->close(); ?>
<?php require_once("rodape.php"); ?>