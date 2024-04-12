<?php
 
    $txt = file_get_contents('php://input');
    $obj = json_decode( $txt, true );
    $cpf = $obj['cpf'];
    $sql = "select  emp.*
            from estudante es
            join aluno a
                on a.estudante = es.id
            join estagio esta
                on a.id = esta.aluno
            join empresa emp
                on esta.empresa = emp.id
            where es.cpf = '$cpf' ";
    $conexao = new pdo ('sqlite:database');
    $resultado = $conexao->query($sql)->fetchAll(2);
    $txt = json_encode( $resultado );
    print $txt;
