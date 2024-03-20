<?php
	$conexao = new pdo ('sqlite:bancodedados.dat');
	
	$create = "create table if not exists covidcases ( id integer primary key autoincrement, unidade text, timestamp datetime ); ";
	$conexao->exec($create);

	$select = "select unidade, count(*) quantidade from covidcases group by unidade order by unidade; ";
	$resultado = $conexao->query($select)->fetchAll();

	unset( $conexao );
?>
<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<h2>Observatório COVID19</h2>
		<table border="1">
			<caption>Relatório de Casos de COVID19</caption>
			<tr>
				<td>Unidade</td>
				<td>Quantidade</td>
			</tr>
<?php
	if ( count($resultado) == 0 ) {
?>
		<tr>
			<td colspan="2">Ainda não há registros de casos de COVID19.</td>
		</tr>
<?php
	} else {
		foreach ( $resultado as $tupla ) {
?>
			<tr>
				<td><?php print $tupla['unidade']; ?></td>
				<td><?php print $tupla['quantidade']; ?></td>
			</tr>
<?php
										 }
	}
?>
		</table>
	</body>
</html>