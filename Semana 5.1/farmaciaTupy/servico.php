<?php

    $txt = file_get_contents('php://input');
    $obj = json_decode( $txt, true );
    $cpf = $obj['cpf'];
    $anvisa = $obj['anvisa'];
    $consulta = " 
        select p.id, v.produto
        from produto p
        join venda v
            on v.produto = p.id
        join cliente c
            on c.id = v.cliente
        where p.anvisa = '$anvisa'
        and c.cpf = '$cpf';";

    $conexao = new pdo ('sqlite:banco.sqlite');
    $resultado = $conexao->query($consulta)->fetchAll();
    if ( count($resultado) > 0 ) {
        $obj = [ 'status' => true ];
    } else {
        $obj = [ 'status' => false ];
    }
    $txt = json_encode( $obj );
    print $txt;

?>