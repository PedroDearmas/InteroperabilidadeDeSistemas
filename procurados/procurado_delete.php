<?php
    $cpf =  $_REQUEST['cpf'];

    $delete = "delete from pessoa  where cpf ='$cpf' ;";
    $conexao = new pdo('sqlite:bd');

    $resultado = $conexao->exec($delete);
    unset($conexao);

    if ($resultado > 0){
        print 'Arquivo deletado com sucesso!';
    ?>
    <script>
        setTimeout(() => {
            window.location = '/procurado_lista.php'
        
        }, 2000);
    </script>
    <?php
    }else{
        print 'Erro. Tente novamente!';
    };


?>