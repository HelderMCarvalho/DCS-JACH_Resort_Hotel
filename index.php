<?php
require_once "db.php";

session_start();

if ($_SESSION["temRes"] == "n"){
    echo '<script type="text/javascript">alert("Não existem despesas entre essas datas!");</script>';
}

$despesas = $conn->query('Select * from seccao');

if ($_SESSION["query"] == null) {
    $res = $conn->query('SELECT produto.nome as prodNome,seccao.nome as secNome,produtoAluguer.dataCompra as data,
round(produto.preco * produtoAluguer.quantidade,2) as total
FROM jach.produtoAluguer INNER JOIN produto ON produtoAluguer.idProduto = produto.id 
INNER JOIN seccao ON produto.idSeccao = seccao.id;');
}
else{
    $res = $_SESSION["query"];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JACH | Cons. Financiera</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/minha.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light minhaNav">
    <a class="navbar-brand" href="#" style="font-size: 35px;margin-left: 10px"><strong>JACH Resort Hotel</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li><a class="nav-link btnNav" href="#">Inicio</a></li>
            <li><a class="nav-link btnNav" href="#">Quartos</a></li>
            <li><a class="nav-link btnNav" href="#">Contactos</a></li>
            <li><a class="nav-link btnNav" href="#">Sair</a></li>
        </ul>
    </div>
</nav>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-11 offset-md-1">
            <h3>Consulta Financiera</h3>
        </div>
    </div>

    <form class="form-inline" method="post" action="consultaFinanceira.php">
        <div class="row formDatas form-group">
            <div class="col-md-2 marginR50">
                <label for="dtnInicial">Data Inicial:</label>
                <input type="date" class="form-control" name="dtnInicial">
            </div>
            <div class="col-md-2 marginR50">
                <label for="dtnFinal">Data Final:</label>
                <input type="date" class="form-control" name="dtnFinal">
            </div>
            <div class="col-md-2 marginR50">
                <label for="tpDespesa">Tipo Despesa:</label>
                <select class="form-control" name="tpDespesa">
                    <?
                    foreach ($despesas as $despesa) {
                        echo '<option value="' . $despesa['id'] . '">' . $despesa['nome'] . '</option>';
                    }
                    ?>

                </select>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-warning">Pesquisar</button>
            </div>
        </div>
    </form>


    <div class="row formTable">
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Tipo Despesa</th>
                    <th scope="col">Dia</th>
                    <th scope="col">Valor</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($res as $item) {
                    $sum += $item['total'];
                    $item['total'] = $item['total'] + 0;
                    echo '<tr>
                                <td>' . $item['prodNome'] . '</td>
                                <td>' . $item['secNome'] . '</td>
                                <td>' . $item['data'] . '</td>
                                <td>' . $item['total'] . '€</td>
                           </tr>';
                }
                $_SESSION["temRes"] = "s";
                session_destroy();
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 offset-md-10">


            <p>Total a pagar: <strong><?= $sum ?></strong>€</p>

        </div>
    </div>

</div>


<script src="./js/bootstrap.js"></script>

</body>
</html>