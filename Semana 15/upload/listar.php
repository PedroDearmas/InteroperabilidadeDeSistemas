<?php

    $conexao = new pdo ('sqlite:banco');
    $sql = "select * from imagem; ";
    $resultado = $conexao->query($sql)->fetchAll(2);
    unset($conexao);

    foreach ( $resultado as $imagem ) {
        print '<img src="data:image/png;base64,'.$imagem['conteudo'].'" />';
    }

    print '
    <style>
        img { width: 200px; border: 4px solid blue; }
    </style>
    ';