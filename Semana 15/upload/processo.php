<?php

    var_dump($_REQUEST);
    var_dump($_FILES);

    $caminho = $_FILES['arquivo']['tmp_name'];
    $conteudo = file_get_contents( $caminho );
    $codificado = base64_encode( $conteudo );
    $descricao = $_REQUEST['descricao'];

    $conexao = new pdo('sqlite:banco');
    $sql = "insert into imagem values ( 
                null, 
                '".$descricao."', 
                '".$codificado."'
            );";
    $resultado = $conexao->exec($sql);
    unset($conexao);
    if ( $resultado ) {
        print 'inserido com sucesso';
    } else {
        print 'erro ao inserir';
    }
?>

<img height="50" src="data:image/png;base64,<?php print($codificado); ?>" />