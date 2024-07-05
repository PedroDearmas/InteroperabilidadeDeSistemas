<?php

    $txt = file_get_contents('php://input');
    $obj = json_decode( $txt, true );
    $conteudo = $obj['conteudo'];
    $conexao = new pdo ('sqlite:banco');
    $sql = " insert into imagem values (null, '$conteudo') returning id ; ";
    $resultado = $conexao->query($sql)->fetchAll(2);
    $id = $resultado[0]['id'];
    $obj = [ "id" => $id ];
    $txt = json_encode( $obj );
    print $txt;