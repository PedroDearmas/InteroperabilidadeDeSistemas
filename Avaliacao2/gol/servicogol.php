<?php
    $txt = file_get_contents('php://input');
    $obj = json_decode($txt,true);
    $origem = $obj['origem'];
    $destino = $obj['destino']; 
    $data = $obj['data'];
    $select = "select  *
    from vvoo 
    where origem = '".$origem."' and destino = '".$destino."' and datahora =  '".$data."' 
    order by datahora";
    $conexao = new pdo ('sqlite:database');
    $resultado = $conexao->query($select)->fetchAll(2);
    $txt = json_encode( $resultado );
    print $txt;
?>