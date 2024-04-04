<?php

    $txt = file_get_contents ('php://input');
    $obj =json_decode($txt, true);
    $entrada = $obj['entrada'];
    include 'funcoes.php';
    $obj = ["status" => "INVALIDO"];
    if (validaCPF($entrada)){
        $obj = ["status" => "CPF"];
    }elseif (validaCNPJ($entrada)){
        $obj = ["status" => "CNPJ"];
    }
    $txt = json_encode ($obj);
    print $txt;
