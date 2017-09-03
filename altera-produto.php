<?php
	require_once("banco-produto.php");
	require_once("class/Produto.php");
	require_once("cabecalho.php");

	$produto = new Produto();

	$produto->nome = $_POST['nome'];
	$produto->preco = $_POST['preco'];
	$produto->descricao = $_POST['descricao'];
	$produto->categoria_id = $_POST['categoria_id'];
	$produto->usado = array_key_exists('usado', $_POST) ? 'true' : 'false';
	$produto->id = $_POST['id'];
?>

<?php if(alteraProduto($con, $produto)): ?>
	<p class="text-success">
		Produto <?php echo $produto->nome; ?> com o valor de R$<?php echo $produto->preco; ?> alterado com sucesso !!
	</p>	
<?php else: ?>
	<p class="text-danger">
		Produto <?php echo $produto->nome; ?> com o valor de R$<?php echo $produto->preco; ?> não foi alterado. Erro: <?php echo $con->error; ?>
	</p>
<?php endif; ?>


<?php $con->close(); ?>
<?php require_once("rodape.php"); ?>