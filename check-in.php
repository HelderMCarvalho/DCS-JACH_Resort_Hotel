<?php
require_once('./php/bd.php');
?>

<?php
$sql='SELECT * FROM reserva WHERE reserva.id='.$_REQUEST['id'].';';
$result = $PDO->query($sql);
$reserva = $result->fetch();

$sql='SELECT * FROM hospede WHERE hospede.id='.$_REQUEST['id'].';';
$result = $PDO->query($sql);
$hospede = $result->fetch();
?>

<!DOCTYPE html>
<html lang="en" style="padding-left: 35px;padding-right: 10px;">
<head>
    <meta charset="UTF-8">
    <title>JACH - Reservas</title>

    <link rel="stylesheet" href="/jach/css/bootstrap.min.css">
    <link rel="stylesheet" href="/jach/css/style.css">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">JACH Resort Hotel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item ">
                <a class="nav-link" style="border: 1px solid;border-color: black;margin-left: 20px;padding: 3px;"href="#">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="border: 1px solid;border-color: black;margin-left: 20px;padding: 3px;" href="#">Quartos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="border: 1px solid;border-color: black;margin-left: 20px;padding: 3px;" href="#">Contacto</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="border: 1px solid;border-color: black;margin-left: 20px;padding: 3px;background: yellow;"href="#">Sair</a>
        </ul>
    </div>
</nav>
<div><h5 class="Titulo">Check-in</h5></div>
<div align="center">
    <form action="/jach/php/check-in.php" method="post">
    <div class="form-row col-md-6 center">
        <div align="left" class="form-group col-md-6">
            <label for="inputNome">Nome:</label>
            <input type="text" class="form-control" id="inputNome" name="inputNome" value="<?=$reserva['nome']?>">
            <input type="hidden" id="idreserva" name="idreserva" value="<?=$reserva['id']?>">
        </div>
        <div align="left" class="form-group col-md-6">
            <label for="inputApelido">Apelido:</label>
            <input type="text" class="form-control" id="inputApelido" name="inputApelido" value="<?=$reserva['apelido']?>">
        </div>
    </div>
    <div class="form-row col-md-6 center">
        <div align="left" class="form-group col-md-6">
            <label for="inputContribuinte">Número de Contribuiente:</label>
            <input type="text" class="form-control" id="inputContribuinte" name="inputContribuinte" >
        </div>
        <div align="left" class="form-group col-md-6">
            <label for="inputTelemovel">Número de Telemóvel:</label>
            <input type="text" class="form-control" id="inputTelemovel" name="inputTelemovel" value="<?=$reserva['numeroTelemovel']?>">
        </div>
    </div>
    <div class="form-row col-md-6 center">
        <div align="left" class="form-group col-md-6">
            <label for="quarto">Número do Quarto:</label>
            <select class="form-control" name="quarto1" >
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
            </select>
        </div>
        <div align="left" class="form-group col-md-6">
            <label for="inputAcompanhantes">Número de Acompanhantes(nao contar o que registou):</label>
            <input type="text" class="form-control" name="inputAcompanhantes" id="inputAcompanhantes" value="<?=$reserva['numeroAcompanhantes']?>">
        </div>
        <div class="form-row col-md-12 center">
            <div align="left" class="form-group col-md-6">
                <label for="inputData">Data:</label>
                <input class="form-control" type="date" name="inputdataCheckOut" value="<?=$reserva['dataCheckOut']?>" id="example-data-input">
            </div>
        </div>
    </div>
    <br>
        <div align="center">
            <a href="reservas.php" class="btn btn-warning">Lista de reservas</a>
            <button type="submit" class="btn btn-warning">Check-in</button>
        </div>
</form>
</div>

<script src="./js/jquery-3.3.1.min.js"></script>
<script src="./js/bootstrap.js"></script>

</body>
</html>
