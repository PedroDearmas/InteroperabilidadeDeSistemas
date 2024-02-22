<?php

$conexao = new pdo('sqlite:bd');
$consulta = 'SELECT cpf,nome FROM pessoa order by nome;';
$resultado = $conexao ->query($consulta)->fetchAll();

unset($conexao);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procurados</title>
</head>
<body>
    <h1>
        Lista de Procurados
    </h1>
    <table border ='1' >
        <tr>
            <th>CPF</th>
            <th>NOME</th>
            
        </tr>
<?php
    foreach($resultado as $tupla){
  ?>
  <tr>
    <td><?php print $tupla['cpf'] ?></td>
    <td><?php print $tupla['nome'] ?></td>
    <td><a href="/procurado_delete.php?cpf=<?php print $tupla['cpf'] ?>">X</a></td>
  </tr>      
<?php    
    }
?>

    </table>

    <p>
        <a href="/procurado_cadastro.php"> Cadastrar</a>
    </p>
</body>
</html>     











































