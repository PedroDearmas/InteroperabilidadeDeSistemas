<?php
	$cpf = $_REQUEST['documento'];
	$obj = ["cpf" => $cpf];
	$txt = json_encode ($obj);

	$curl = curl_init("http://localhost:8081/servico.php");
	curl_setopt($curl, CURLOPT_POSTFIELDS, $txt);
	curl_setopt($curl, CURLOPT_HTTPHEADER, ['application/json']);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$txt = curl_exec($curl);
	$obj = json_decode ($txt, true);
	if ($obj['status'] == 'procurado'){
		print 'Procurado!! Chame a policia!!';
	}

	$conexao = new pdo('sqlite:bancodedados.data');
	$insert = "insert into paciente values (null, '".$_REQUEST['documento']."', '".$_REQUEST['nome']."', '".$_REQUEST['sexo']."', '".$_REQUEST['nascimento']."', '".$_REQUEST['email']."', '".$_REQUEST['fone']."', '".$_REQUEST['moradia']."', '', datetime('now') );";
	$resultado1 = $conexao->exec($insert);
	$pid = "select max(id) pid from paciente;";
	$pid = $conexao->query($pid)->fetchAll();
	$pid = $pid[0]['pid'];
	$insert = "insert into triagem values (null, '".$pid."', null, null, null, null, null, null, null);";
	$resultado2 = $conexao->exec($insert);
	unset($conexao);
	if ( $resultado1 > 0 and $resultado2 > 0 ) {	
		print 'Inserido com sucesso.';
		print '<script>window.setTimeout(function(){window.location=\'/paciente_cadastro.php\';}, 2000);</script>';
	} else {
		print 'Erro na inserção.';
	}
?>
