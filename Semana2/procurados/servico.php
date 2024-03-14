<?php

    $txt = file_get_contents('php://input');
    $obj = json_decode( $txt, true );
    $cpf = $obj['cpf'];
    $consulta = " select * from pessoa where cpf = '$cpf'; ";
    $conexao = new pdo ('sqlite:db');
    $resultado = $conexao->query($consulta)->fetchAll();
    if ( count($resultado) > 0 ) {
        $obj = [ 'status' => 'procurado' ];
    } else {
        $obj = [ 'status' => 'nada consta' ];
    }
    $txt = json_encode( $obj );
    print $txt;