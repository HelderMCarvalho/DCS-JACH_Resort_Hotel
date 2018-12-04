<?php
    require_once '../php/bd.php';
    require_once './parciais/head1.html';
    session_start();
?>
    <title>Check-In | JACH</title>
<?php
    require_once './parciais/head2.php';

    $sql='SELECT * FROM aluguer;';
    $result = $PDO->query($sql);
    $alugueres = $result->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_REQUEST['id'])){
        $sql='SELECT * FROM reserva WHERE reserva.id='.$_REQUEST['id'].';';
        $result = $PDO->query($sql);
        $reserva = $result->fetch(PDO::FETCH_ASSOC);

        $sql='SELECT id, id AS nome FROM quarto WHERE idTipoQuarto='.$reserva['idTipoQuarto'].';';
        $result = $PDO->query($sql);
        $quartos = $result->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        $sql='SELECT quarto.id, CONCAT(quarto.id, " - ", tipoQuarto.nome) AS nome FROM quarto INNER JOIN tipoQuarto ON quarto.idTipoQuarto = tipoQuarto.id;';
        $result = $PDO->query($sql);
        $quartos = $result->fetchAll(PDO::FETCH_ASSOC);
    }

    if (isset($_SESSION['novoAluguer'])){ ?>
        <script>alert('Aluguer criado com sucesso! \n     Número de aluguer: <?=$_SESSION['novoAluguer']['id']?> \n     Palavra-passe: <?=$_SESSION['novoAluguer']['palavraPasse']?>');</script>
<?php }
    unset($_SESSION['novoAluguer']);
?>
    <div class="row conteudo">
        <div class="col-md-4 offset-md-2 col-12">
            <h3>Check-In</h3>
        </div>
        <div class="col-md-6 offset-md-3">
            <form action="/php/checkInBD.php" method="post">
                <input type="hidden" id="inputReserva" name="inputReserva" value="<?=$reserva['id']?>">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputNome">Nome:</label>
                        <input type="text" class="form-control" id="inputNome" name="inputNome" value="<?=$reserva['nome']?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputApelido">Apelido:</label>
                        <input type="text" class="form-control" id="inputApelido" name="inputApelido" value="<?=$reserva['apelido']?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputContribuinte">Número de Contribuiente:</label>
                        <input type="text" class="form-control" id="inputContribuinte" name="inputContribuinte" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputTelemovel">Número de Telemóvel:</label>
                        <input type="text" class="form-control" id="inputTelemovel" name="inputTelemovel" value="<?=$reserva['numeroTelemovel']?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputQuarto">Número do Quarto:</label>
                        <select class="form-control" name="inputQuarto" id="inputQuarto">
                            <option></option>
                            <?php
                                foreach($quartos as $quarto){
                                    foreach ($alugueres as $aluguer) {
                                        if ($quarto['id'] == $aluguer['idQuarto']) {
                                            $ocupado = true;
                                            break;
                                        }
                                    }
                                    if ($ocupado==true){ ?>
                                        <option disabled value="<?=$quarto['id']?>"><?=$quarto['nome']?></option>
                            <?php       $ocupado=false;
                                    } else{ ?>
                                            <option value="<?=$quarto['id']?>"><?=$quarto['nome']?></option>
                            <?php         }
                                    }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputAcompanhantes">Número de Acompanhantes (nao contar o que registou):</label>
                        <input type="text" class="form-control" name="inputAcompanhantes" id="inputAcompanhantes" value="<?=$reserva['numeroAcompanhantes']?>">
                    </div>
                </div>
                <div class="row">
                    <div align="left" class="form-group col-md-6">
                        <label for="inputDataCheckOut">Data de Check-Out:</label>
                        <input class="form-control" type="date" id="inputDataCheckOut" name="inputDataCheckOut" value="<?=$reserva['dataCheckOut']?>">
                    </div>
                </div>
                <div class="text-center">
                    <a href="./reservas.php" class="btn btn-warning">Lista de reservas</a>
                    <button type="submit" class="btn btn-warning">Check-in</button>
                </div>
            </form>
        </div>
    </div>
<?php
    require_once './parciais/foot.html';
?>