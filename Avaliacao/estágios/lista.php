<?php
	if ( !isset($_REQUEST['entidade']) ) {
		print 'Erro.';
		exit;
	}
	$sql = " select * from ".$_REQUEST['entidade']."; ";
	if ( isset( $_REQUEST['view'] ) ) {
		$sql = " select * from v".$_REQUEST['entidade']."; ";
	}
	$conexao = new pdo ('sqlite:database');
	$meta = $conexao->query( $sql );
	$columns = [];
	for ( $i = 0 ; $i < $meta->columnCount() ; $i++ ) {
		$columns[] = $meta->getColumnMeta($i)['name'];
	}
	$resultado = $meta->fetchAll(2);
?>
<html>
	<head>
		<meta charset="utf-8" />
		<style>
			form, div { display: inline-block; }
			button { float: right; }
		</style>
	</head>
	<body>
		<p>
			<a href="lista.php?entidade=estudante&rotulo=Estudante">Estudante</a>
			<a href="lista.php?entidade=instituicao&rotulo=Instituição">Instituição</a>
			<a href="lista.php?entidade=aluno&rotulo=Aluno&view">Aluno</a>
			<a href="lista.php?entidade=empresa&rotulo=Empresa">Empresa</a>
			<a href="lista.php?entidade=estagio&rotulo=Estágio&view">Estágio</a>
		</p>
		<h2>Lista de <?= $_REQUEST['rotulo'] ?></h2>
		<div>
			<table border="1">
				<tr>
	<?php foreach ( $columns as $column ) { ?>
					<td><?= $column ?></td>
	<?php } ?>
					<td>Remover</td>
				</tr>
	<?php foreach ( $resultado as $tupla ) { ?>
				<tr>
	<?php 	for ( $i = 0 ; $i < count($tupla) ; $i++ ) { ?>
					<td><?= $tupla[$columns[$i]] ?></td>
	<?php 	} ?>
					<td><a href="/delete.php?entidade=<?= $_REQUEST['entidade'] ?>&rotulo=<?= $_REQUEST['rotulo'] ?>&id=<?= $tupla['id'] ?><?= (isset($_REQUEST['view']) ? '&view' : '') ?>"> X </a></td>
				</tr>
	<?php } ?>
			</table>
			<p>
				<a href="/cadastro.php?entidade=<?= $_REQUEST['entidade'] ?>&rotulo=<?= $_REQUEST['rotulo'] ?><?= (isset($_REQUEST['view']) ? '&view' : '') ?>"><button>Inserir</button></a>
			</p>
		</div>
	</body>
</html>