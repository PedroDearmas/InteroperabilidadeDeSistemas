<?php

    $documento = $_REQUEST['documento'];
    $sql = "select a.datahora, a.diagnostico from  paciente p join triagem t on t.paciente = 
    p.id join atendimento a on a.triagem  = t.id where p.documento = '$documento';";
    $conexao = new pdo ('sqlite:bancodedados.data');
    $resultado = $conexao->query($sql)->fetchAll(2);
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php include 'menu.php';?>
        <table border="1">
            <tr>
                <th>Data hora</th>
                <th>Diagnostico</th>
            </tr>
        <?php foreach  ($resultado as $tupla) { ?>
            <tr>
                <th><?php print $tupla['datahora'];?></th>
                <th><?php print $tupla['diagnostico'];?></th>
            </tr>
        <?php } ?>
        </table> 
    </body>
    </html>