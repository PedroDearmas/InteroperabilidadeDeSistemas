<?php
    $txt = file_get_contents('php://input');
    $obj = json_decode($txt, true);
    $cpf = $obj['cpf'];
    $nome = $obj['nome'];
    $id = $obj['id'];

    $buscacli = "select id from cliente where cpf = '".$cpf."'";
    $conexao = new PDO('sqlite:database');
    $resultado = $conexao->query($buscacli)->fetchAll(0);
    if ($resultado && count($resultado) > 0) {
        $idcli = $resultado[0]['id'];
    } else {
        $inserecli = "insert into cliente values (null, '".$cpf."', '".$nome."')returning id;";
        $resultado = $conexao->query($inserecli)->fetchAll(0);
        $idcli = $resultado[0]['id'];
    }
    $inserepass = "insert into passageiro values (null, '".$id."', '".$idcli."')returning id;";
    $resultado = $conexao->query($inserepass)->fetchAll(0);
    $idpass = $resultado[0]['id'];
    if ($idpass > 0) {
        $resultcomp = ["status" => "true", "passagem" => $idpass];
    } else {
        $resultcomp = ["status" => "false"];
    }
    $txt = json_encode($resultcomp);
    print $txt;
?>