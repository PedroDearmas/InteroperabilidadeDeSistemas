<?php

    $txt = file_get_contents('php://input');
    $obj = json_decode( $txt, true );
    $cpf = $obj['cpf'];
    $anvisa = $obj['anvisa'];
    $sql = "
        select *
        from 
        (
            select v.datahora, c.cpf, p.anvisa
            from venda v
            join produto p
            on v.produto = p.id
            join cliente c
            on v.cliente = c.id
            where c.cpf = '$cpf'
            order by v.datahora desc
            limit 3
        ) as compras
        where anvisa = '$anvisa';
    ";
    $conexao = new pdo('sqlite:banco.sqlite');
    $resultado = $conexao->query($sql)->fetchAll(2);
    $obj = [ 'desconto' => false ];
    if ( count($resultado) > 0 ) {
        $obj = [ 'desconto' => true ];
    }
    $txt = json_encode( $obj );
    print $txt;