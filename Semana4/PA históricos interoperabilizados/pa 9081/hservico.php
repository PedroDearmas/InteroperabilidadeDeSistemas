<?php

    //$documento = $_REQUEST['documento'];
    $txt = file_get_contents('php://input');
    $obj = json_decode( $txt, true );
    $documento = $obj['documento'];
    $sql = "    select a.datahora, a.diagnostico 
                from paciente p 
                join triagem t 
                    on t.paciente = p.id 
                join atendimento a 
                    on a.triagem = t.id 
                where p.documento = '$documento'; ";
    $conexao = new pdo ('sqlite:bancodedados.data');
    $resultado = $conexao->query($sql)->fetchAll(2);
    $txt = json_encode( $resultado );
    print $txt;
    
?>