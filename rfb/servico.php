<?php

    $txt = file_get_contents ('php://input');
    // ["cpf" : "12345678911"]
    $obj =json_decode($txt, true);
    $cpf = $obj['cpf'];
    include 'funcoes.php';
    $obj = ["status" => valida($cpf)];
    $txt = json_encode ($obj);
    print $txt;
