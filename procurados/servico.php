<?php

    $txt = file_get_contents('php://input');
    json_decode($txt, true);
    $cpf = $obj ['cpf'];
    $consulta = "select * from pessoa cpf = '$cpf';";
    $conexao = new pdo ('sqlite:bd');
    $resultado = $conexao->query($consulta)->fetchAll();
    if(count ($resultado) > 0){
        $obj = ['status' => 'procurado'];
    } else {
        $obj = ['status' => 'Nada consta.'];
    }
    $txt = json_encode ($obj);
    print $txt;
?>