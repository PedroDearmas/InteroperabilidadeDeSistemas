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
        </table>

    </body>
</html>