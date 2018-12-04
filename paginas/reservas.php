<?php
    require_once '../php/bd.php';
    require_once './parciais/head1.html';
    session_start();
?>
    <title>Reservas | JACH</title>
<?php
    require_once './parciais/head2.php';
    $sql='SELECT reserva.id, reserva.nome, reserva.apelido, tipoQuarto.nome AS "nomeTipoQuarto" FROM reserva INNER JOIN tipoQuarto WHERE reserva.idTipoQuarto=tipoQuarto.id;';
    $result = $PDO->query($sql);
    $reservas = $result->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="row conteudo">
        <div class="col-md-4 offset-md-2 col-12">
            <h3>Reservas</h3>
        </div>
        <div class="row col-md-12">
            <div class="col-md-6">
                <form>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Nome...">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="apelido">Apelido:</label>
                            <input type="text" id="myInput2" class="form-control" onkeyup="myFunction2()" placeholder="Apelido...">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12 table-responsive">
            <table class="table table-bordered table-light table-hover table-sm" id="tabela">
                <thead>
                    <tr>
                        <th scope="col" style="width: 40%" class="text-center">Nome</th>
                        <th scope="col" style="width: 40%" class="text-center">Apelido</th>
                        <th scope="col" style="width: 10%" class="text-center">Tipo de Quarto</th>
                        <th scope="col" style="width: 20%" class="text-center">+</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($reservas as $reserva){ ?>
                            <tr>
                                <td class="align-middle"><?=$reserva['nome']?></td>
                                <td class="align-middle"><?=$reserva['apelido']?></td>
                                <td class="align-middle text-center"><?=$reserva['nomeTipoQuarto']?></td>
                                <td class="align-middle text-center"><a href="./checkIn.php?id=<?=$reserva['id']?>" class="btn btn-warning">Check-in</a></td>
                            </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
    require_once './parciais/foot.html';
?>