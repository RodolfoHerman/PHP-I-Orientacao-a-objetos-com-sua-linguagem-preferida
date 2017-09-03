<?php
	require_once("banco-produto.php");
	require_once("logica-usuario.php");
	require_once("class/Produto.php");
	require_once("class/Categoria.php");
	require_once("cabecalho.php");

	verificaUsuario();

	$produto = new Produto();
	$categoria = new Categoria();

	$categoria->id = $_POST['categoria_id'];

	$produto->nome = $_POST['nome'];
	$produto->preco = $_POST['preco'];
	$produto->descricao = $_POST['descricao'];
	$produto->categoria = $categoria;
	$produto->usado = array_key_exists('usado', $_POST) ? 'true' : 'false';
?>

<?php if(insereProduto($con, $produto)): ?>
	<p class="text-success">
		Produto <?php echo $produto->nome; ?> com o valor de R$<?php echo $produto->preco; ?> adicionado com sucesso !!
	</p>	
<?php else: ?>
	<p class="text-danger">
		Produto <?php echo $produto->nome; ?> com o valor de R$<?php echo $produto->preco; ?> não foi adicionado. Erro: <?php echo $con->error; ?>
	</p>
<?php endif; ?>


<?php $con->close(); ?>
<?php require_once("rodape.php"); ?>