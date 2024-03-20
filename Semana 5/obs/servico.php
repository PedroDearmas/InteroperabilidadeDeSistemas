<?php

    $txt = file_get_contents('php://input'); // captura o conteúdo da requisição.
    $obj = json_decode( $txt, true ); // tenta decodificar o conteúdo da requisição como um objeto da linguagem PHP.
    $un = $obj['unidade']; // espera-se que o objeto seja um vetor que possui o índice unidade. o valor associado ao índice do vetor é isolado na variável $un.
    $conexao = new pdo('sqlite:bancodedados.dat'); // conecta no banco de dados.
    $sql = " insert into covidcases values ( null, '$un', date('now') ); "; // monta a sentença de inserção.
    $resultado = $conexao->exec( $sql ); // executa a inserção.
    $obj = [ 'status' => $resultado ]; // monta a estrutura a ser retornada a quem consome o serviço web.
    $txt = json_encode( $obj ); // codifica a estrutura de retorno como JSON.
    print $txt; // dá retorno à requisção.