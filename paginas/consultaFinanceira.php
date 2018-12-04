<?php
    require_once '../php/bd.php';
    require_once './parciais/head1.html';
    session_start();

    if ($_SESSION["temRes"] == "n"){
        echo '<script type="text/javascript">alert("Não existem despesas entre essas datas!");</script>';
    }

    $sql='SELECT * FROM seccao;';
    $result = $PDO->query($sql);
    $despesas = $result->fetchAll(PDO::FETCH_ASSOC);

    if ($_SESSION["query"] == null) {
        $sql='SELECT produto.nome as prodNome, seccao.nome as secNome, produtoAluguer.data as data, round(produto.preco * produtoAluguer.quantidade, 2) as total, produtoAluguer.quantidade as quantidade FROM produtoAluguer INNER JOIN produto ON produtoAluguer.idProduto = produto.id INNER JOIN seccao ON produto.idSeccao = seccao.id WHERE produtoAluguer.idAluguer=1;';
        $result = $PDO->query($sql);
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        $res = $_SESSION["query"];
    }
    unset($_SESSION['res']);
    unset($_SESSION['query']);
?>
    <title>Cons. Financiera | JACH</title>
<?php
    require_once './parciais/head2.php';
?>
<div class="conteudo">
    <div class="row">
        <div class="col-md-6 text-center">
            <h3>Consulta Financiera</h3>
        </div>
    </div>
    <form class="form" method="post" action="/php/consultaFinanceiraBD.php">
        <div class="form-row">
            <div class="col-md-2 form-group">
                <label for="dtnInicial">Data Inicial:</label>
                <input type="date" class="form-control" name="dtnInicial" id="dtnInicial">
            </div>
            <div class="col-md-2 form-group">
                <label for="dtnFinal">Data Final:</label>
                <input type="date" class="form-control" name="dtnFinal" id="dtnFinal">
            </div>
            <div class="col-md-2 form-group">
                <label for="tpDespesa">Tipo Despesa:</label>
                <select class="form-control" name="tpDespesa" id="tpDespesa">
                    <?php
                        foreach ($despesas as $despesa) {
                            echo '<option value="'.$despesa['id'].'">'.$despesa['nome'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div style="position: relative">
                <button type="submit" class="btn btn-warning" style="position: absolute; bottom: 0; margin-bottom: 1rem;">Pesquisar</button>
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
                    <th scope="col">Quantidade</th>
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
                                    <td>' . $item['quantidade'] . '</td>
                                    <td>' . $item['total'] . '€</td>
                               </tr>';
                    }
                    $_SESSION["temRes"] = "s";
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 offset-md-10">
            Total a pagar: <strong><?=$sum?></strong>€
        </div>
    </div>
<?php
    require_once './parciais/foot.html';
?>