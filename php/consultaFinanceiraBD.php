<?php
    require_once './bd.php';
    session_start();

    //Vars
    $dataInicial = $_POST['dtnInicial'];
    $dataFinal   = $_POST['dtnFinal'];
    $tipoDespesa = $_POST['tpDespesa'];

    $sql='SELECT produto.nome as prodNome, seccao.nome as secNome, produtoAluguer.data as data,
round(produto.preco * produtoAluguer.quantidade,2) as total, produtoAluguer.quantidade as quantidade
FROM produtoAluguer INNER JOIN produto ON produtoAluguer.idProduto = produto.id 
INNER JOIN seccao ON produto.idSeccao = seccao.id 
WHERE idAluguer = '.$_SESSION['aluguerAutenticado']['id'].' and idSeccao = '.$tipoDespesa.' AND data BETWEEN "'.$dataInicial.'" AND "'.$dataFinal.'"';
    $res = $PDO->query($sql);
    $res = $res->fetchAll(PDO::FETCH_ASSOC);

    if (count($res)==0){
        $_SESSION["temRes"] = "n";
    }
    else{
        $_SESSION["temRes"] = "s";
        $_SESSION["query"] = $res;
    }

    header("Location: /paginas/consultaFinanceira.php");