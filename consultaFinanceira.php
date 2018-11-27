<?php
require_once "db.php";

/**
 * var_dump($_POST);
 * 'dtnInicial' => string '2018-11-01' (length=10)
 * 'dtnFinal' => string '2018-11-02' (length=10)
 * 'tpDespesa' => string '2' (length=1)
 */

//Vars
$dataInicial = $_POST['dtnInicial'];
$dataFinal   = $_POST['dtnFinal'];
$tipoDespesa = $_POST['tpDespesa'];

$res = $conn->query("SELECT produto.nome as prodNome,seccao.nome as secNome,produtoAluguer.dataCompra as data,
round(produto.preco * produtoAluguer.quantidade,2) as total
FROM jach.produtoAluguer INNER JOIN produto ON produtoAluguer.idProduto = produto.id 
INNER JOIN seccao ON produto.idSeccao = seccao.id 
where idAluguer = 1 and idSeccao = '".$tipoDespesa."' AND dataCompra BETWEEN '". $dataInicial . "' AND '". $dataFinal . ";'")->fetchAll();

session_start();

if (count($res)==0){
    $_SESSION["temRes"] = "n";

}
else{
    $_SESSION["temRes"] = "s";
    $_SESSION["query"] = $res;
}

header("Location: http://jach.com");


