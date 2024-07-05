<?php

    $txt = file_get_contents('php://input');
    $obj = json_decode( $txt, true );
    $id = $obj['id'];
    $sql = "select conteudo from imagem where id = '$id'; ";
    $conexao = new pdo ('sqlite:banco');
    $resultado = $conexao->query($sql)->fetchAll(2);
    $conteudo = $resultado[0]['conteudo'];
    $obj = [ "conteudo" => $conteudo ];
    $txt = json_encode( $obj );
    print $txt;