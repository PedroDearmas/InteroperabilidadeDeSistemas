<?php

	$diag = $_REQUEST['diagnostico'];
	$teste = strpos($diag, 'covid');
	$obj = [ 'unidade' => 'São Judas' ];
	$txt = json_encode($obj);
	if ( $teste !== false ) {
		$curl = curl_init('http://localhost:9083/servico.php');
		curl_setopt( $curl, CURLOPT_POSTFIELDS, $txt );
		curl_setopt( $curl, CURLOPT_HTTPHEADER, [ 'Content-type:application/json' ] );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		$txt = curl_exec($curl);
		$obj = json_decode($txt, true);
		if ( $obj['status'] == '1' ) {
			print 'Caso de COVID informado com sucesso. ';
		}
	}

	$conexao = new pdo('sqlite:bancodedados.data');
	$insert = "insert into atendimento values (null, '".$_REQUEST['triagem']."', '".$_REQUEST['diagnostico']."', '".$_REQUEST['medicamento']."', '".$_REQUEST['encaminhamento']."', datetime('now') );";
	$resultado = $conexao->exec($insert);
	unset($conexao);
	if ( $resultado > 0 ) {
		print 'Inserido com sucesso.';
		print '<script>window.setTimeout(function(){window.location=\'/atendimento_lista.php\';}, 2000);</script>';
	} else {
		print 'Erro na inserção.';
	}
?>