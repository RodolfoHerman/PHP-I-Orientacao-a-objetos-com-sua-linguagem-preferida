<table class="table">
	<tr>
		<th>Nome: </th>
		<td><input class="form-control" type="text" name="nome" value="<?php echo $produto->nome; ?>" /></td>
	</tr>
	<tr>
		<th>Preço: </th>
		<td><input class="form-control" type="number" name="preco" value="<?php echo $produto->preco; ?>" /></td>
	</tr>
	<tr>
		<th>Descrição: </th>
		<td><textarea class="form-control" name="descricao"><?php echo $produto->descricao; ?></textarea></td>
	</tr>
	<tr>
		<th></th>
		<td style="text-align: left;"><input type="checkbox" name="usado" <?php echo $produto->usado ? 'checked' : ''; ?> /> Usado</td>
	</tr>
	<tr>
		<th>Categoria: </th>
		<td>
			<select class="form-control" name="categoria_id">
				<?php foreach(listaCategorias($con) as $categoria): ?>
					<?php $selecao = $categoria->id == $produto->categoria->id ? 'selected' : ''; ?>
					<option value="<?php echo $categoria->id ?>" <?php echo $selecao ?>><?php echo $categoria->nome ?></option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>