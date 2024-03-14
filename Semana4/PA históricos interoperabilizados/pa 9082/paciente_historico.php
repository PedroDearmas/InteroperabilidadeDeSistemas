<?php

    $documento = $_REQUEST['documento'];
    $sql = "    select a.datahora, a.diagnostico 
                from paciente p 
                join triagem t 
                    on t.paciente = p.id 
                join atendimento a 
                    on a.triagem = t.id 
                where p.documento = '$documento'; ";
    $conexao = new pdo ('sqlite:bancodedados.data');
    $resultado = $conexao->query($sql)->fetchAll(2);

    $curl = curl_init('http://localhost:9081/hservico.php');
    $obj = [ 'documento' => $documento ];
    $txt = json_encode( $obj );
    curl_setopt( $curl, CURLOPT_POSTFIELDS, $txt );
    curl_setopt( $curl, CURLOPT_HTTPHEADER, [ 'Content-type:application/json' ] );
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
    $txt = curl_exec( $curl );
    $remoto = json_decode( $txt, true );

?>

<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <?php include 'menu.php'; ?>
        <table border="1">
            <tr>
                <th>Data Hora</th>
                <th>Diagnóstico</th>
            </tr>
<?php   foreach ( $resultado as $tupla ) { ?>
            <tr>
                <td><?php print $tupla['datahora']; ?></td>
                <td><?php print $tupla['diagnostico']; ?></td>
            </tr>
<?php   } ?>
<?php   foreach ( $remoto as $tupla ) { ?>
            <tr>
                <td><?php print $tupla['datahora']; ?></td>
                <td><?php print $tupla['diagnostico']; ?></td>
            </tr>
<?php   } ?>
        </table>

    </body>
</html>