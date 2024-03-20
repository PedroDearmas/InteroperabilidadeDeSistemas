<?php
	
	//Espanha = 8081
	//Osorio = 8082
	//Tupy = 8083

	$teste = false; 

	$curl = curl_init("http://localhost:8081/servico.php");
	curl_setopt( $curl, CURLOPT_POSTFIELDS, $txt );
	curl_setopt( $curl, CURLOPT_HTTPHEADER, [ 'application/json' ] );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
	$txt = curl_exec( $curl );
	$obj = json_decode( $txt, true );
	if ( $obj['status'] == 'true' ) {
		$teste = true;
	}

	$curl = curl_init("http://localhost:8083/servico.php");
	curl_setopt( $curl, CURLOPT_POSTFIELDS, $txt );
	curl_setopt( $curl, CURLOPT_HTTPHEADER, [ 'application/json' ] );
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
	$txt = curl_exec( $curl );
	$obj = json_decode( $txt, true );
	if ( $obj['status'] == 'true' ) {
		$teste = true;
	}
	$sql = " insert into venda values (null, '" . $_REQUEST['produto'] . "', '" . $_REQUEST['cliente'] . "', datetime('now'), ( select valor from produto where id = '" . $_REQUEST['produto'] . "') ); ";
	if ( $teste == true){  
		$sql = " insert into venda values (null, '" . $_REQUEST['produto'] . "', '" . $_REQUEST['cliente'] . "', datetime('now'), ( select valor * 0.9 from produto where id = '" . $_REQUEST['produto'] . "') ); ";
	}
	
	$conexao = new pdo ('sqlite:banco.sqlite');
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$resultado = $conexao->exec($sql);
	unset($conexao);
	if ( $resultado ) {
?>	
		<p>Inserido com sucesso.</p>
		<script> setTimeout( function() { window.location.assign('venda_listar.php'); }, 2000); </script>
<?php
	} else {
?>
		<p>Erro ao inserir.</p>
		<script> setTimeout( function() { window.history.back(); }, 2000); </script>
<?php
	}
?>