<?php
    require_once './pages/partials/header.php';
    session_start();
    $tipoQuartoSQL=$_REQUEST['idTipoQuarto'];
    $sql='SELECT caminho FROM fotografia WHERE idTipoQuarto='.$tipoQuartoSQL.'';
    $result = $PDO->query($sql);
    $listaCaminhos = $result->fetchAll();

    $sql='SELECT nome FROM tipoQuarto WHERE id='.$tipoQuartoSQL.'';
    $result = $PDO->query($sql);
    $nomeQuarto = $result->fetchAll();    
?>
    <title>Reserva</title>

<?php if (isset($_SESSION['reserva']) && ($_SESSION['reserva']==true)){
    //echo $_SESSION["reserva"];
    echo "<script>alert('Reserva feita com sucesso!');</script>";
}elseif(isset($_SESSION['reserva']) && ($_SESSION['reserva']==false)){
    echo "<script>alert('O nosso Hotel está cheio nessa data!');</script>";
}
unset($_SESSION['reserva']);
?>
<div class="container-fluid reserva">
    <div class="row">   
        <div class="col-md-6 ">
            <?php
                foreach($nomeQuarto as $nome){?>
                    <h1><?=$nome['nome']?></h1>
            <?php } ?>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>

                <?php
                
                $listaCaminhosImagem=$listaCaminhos;
                $count=1;
                array_shift($listaCaminhosImagem);
                foreach($listaCaminhosImagem as $caminho){?>                    
                    <li data-target="#carouselExampleIndicators" data-slide-to="<?=$count?>"></li>
                    <?php
                        $count=$count+1;
                    ?>
                <?php } ?>                
                </ol>
                <div class="carousel-inner">

                <div class="carousel-item active">
                    <img class="d-block w-100"  src="<?=reset($listaCaminhos)['caminho']?>" alt="First slide" >
                </div> 

                <?php
                array_shift($listaCaminhos);
                foreach($listaCaminhos as $caminho){?>
                    <div class="carousel-item ">
                        <img src="<?=$caminho['caminho']?>" class="d-block w-100">
                    </div>
                <?php } ?>
                <!--
                    <div class="carousel-item active">
                        <img class="d-block w-100"  src="img/quartoMedio.jpg" alt="First slide" >
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100"  src="img/quartoMedio2.jpg" alt="Second slide ">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100"  src="img/quartoMedio3.jpg" alt="Third slide ">
                    </div>
                    -->
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
        <div class="col-md-6" style="margin-top: 40px;">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea odio, illo in sapiente nobis eos reiciendis eaque, voluptatum quo ipsum ipsam animi aperiam dolorum perspiciatis deleniti laboriosam. Repudiandae, repellendus vero?
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea odio, illo in sapiente nobis eos reiciendis eaque, voluptatum quo ipsum ipsam animi aperiam dolorum perspiciatis deleniti laboriosam. Repudiandae, repellendus vero? 
                <form method="POST"  id="myForm" action="/insert.php">
                    <input type="hidden" name="idTipoQuarto" id="idTipoQuarto" value="<?php echo $_REQUEST['idTipoQuarto'];?>" required>
                    <div class="col-md-12  form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Nome:</label>
                                <input action="text" name="nome" id="nome" class="form-control" required>
                                <label id="errormessage"></label>
                            </div>
                            <div class="col-md-6">     
                                <label for="name">Apelido:</label>
                                <input action="text" name="apelido" id="apelido" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12  form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Número de telemóvel:</label>
                                <input action="text" name="numero" id="numero" class="form-control" required>
                                <label id="errormessage"></label>
                            </div>
                            <div class="col-md-6">     
                                <label for="estado">Número de acompanhantes:</label>
                                <select class="form-control" name="acompanhantes" id="acompanhantes" required>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="name">Data de check-in:</label>
                                <input type="date" id="startDate" name="startDate">                                
                            </div>
                            <div class="col-md-6 form-group">     
                            <label for="name">Data de check-out:</label>
                            <input type="date" id="endDate" name="endDate">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group" style="text-align: center;">
                        <div class="row">   
                            <div class="col-md-12">
                                <button type="submit" name="submit" class="btn btn-warning">Reservar</button>
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
<?php
    require_once './pages/partials/footer.html';
    exit();
?>
