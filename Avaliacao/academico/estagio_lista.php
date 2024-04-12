<?php
    $curl = curl_init('http://localhost:8082/servico.php');
    $obj = ["cpf" => $_REQUEST['cpf']];
    $txt = json_encode($obj);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $txt);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-type:application/json']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    $obj = json_decode($response, true);
?>
<html>
        <head>
            <meta charset="utf-8" />
        </head>
        <body>
            <?php include 'menu.php'; ?>
            <h1>Lista de Estágios do Aluno com o seguinte CPF: <?php echo $_REQUEST['cpf']; ?></h1>
            <table border="1">
                <tr>
                    <td>id</td>
                    <td>Nome</td>
                    <td>CNPJ</td>
                </tr>
                <?php foreach ($obj as $tupla){ ?>
                    <tr>
                        <td><?php echo $tupla['id']; ?></td>
                        <td><?php echo $tupla['nome']; ?></td>
                        <td><?php echo $tupla['cnpj']; ?></td>
                    </tr>
                <?php }?>
            </table>
        </body>
    </html>