<?php
    require_once '../php/bd.php';
    require_once './parciais/head1.html';
    session_start();

    $sql='SELECT caminho FROM fotografia WHERE idTipoQuarto='.$_REQUEST['idTipoQuarto'].';';
    $result = $PDO->query($sql);
    $listaCaminhos = $result->fetchAll(PDO::FETCH_ASSOC);

    $sql='SELECT nome, descricao FROM tipoQuarto WHERE id='.$_REQUEST['idTipoQuarto'].';';
    $result = $PDO->query($sql);
    $quarto = $result->fetch(PDO::FETCH_ASSOC);
?>
    <title>Reserva | JACH</title>
<?php
    require_once './parciais/head2.php';
    if (isset($_SESSION['reserva']) && ($_SESSION['reserva']==true)){
        echo "<script>alert('Reserva feita com sucesso!');</script>";
    }elseif(isset($_SESSION['reserva']) && ($_SESSION['reserva']==false)){
        echo "<script>alert('O nosso Hotel está cheio nessa data!');</script>";
    }
    unset($_SESSION['reserva']);
?>
<div class="container-fluid reserva conteudo">
    <div class="row">
        <div class="col-md-6 text-center">
            <h3><?=$quarto['nome']?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 text-center">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <?php
                    $listaCaminhosImagem=$listaCaminhos;
                    $count=1;
                    array_shift($listaCaminhosImagem);
                    foreach($listaCaminhosImagem as $caminho){ ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?=$count?>"></li>
                    <?php
                        $count=$count+1;
                    }
                ?>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100"  src="<?=reset($listaCaminhos)['caminho']?>" alt="First slide" >
                    </div>
                    <?php
                        array_shift($listaCaminhos);
                        foreach($listaCaminhos as $caminho){ ?>
                            <div class="carousel-item ">
                                <img src="<?=$caminho['caminho']?>" class="d-block w-100">
                            </div>
                    <?php } ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <p><?=$quarto['descricao']?></p>
            <form action="/php/reservarQuartoBD.php" method="post">
                <input type="hidden" name="idTipoQuarto" id="idTipoQuarto" value="<?php echo $_REQUEST['idTipoQuarto'];?>" required>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" class="form-control" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="apelido">Apelido:</label>
                        <input type="text" name="apelido" id="apelido" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="numero">Número de telemóvel:</label>
                        <input type="number" name="numero" id="numero" class="form-control" required>
                        <label id="errormessage"></label>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="acompanhantes">Número de acompanhantes:</label>
                        <select class="form-control" name="acompanhantes" id="acompanhantes" required>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="startDate">Data de check-in:</label>
                        <input type="date" id="startDate" name="startDate" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="endDate">Data de check-out:</label>
                        <input type="date" id="endDate" name="endDate" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" name="submit" class="btn btn-warning">Reservar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    require_once './parciais/foot.html';
?>