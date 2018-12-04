<?php
    require_once('./php/bd.php');
?>

<?php
    $sql='SELECT * FROM reserva';
    $result = $PDO->query($sql);
    $reservas = $result->fetchAll();
?>

<!DOCTYPE html>
<html lang="en" style="padding-left: 35px;padding-right: 10px;">
<head>
    <meta charset="UTF-8">
    <title>JACH - Reservas</title>
    <link rel="stylesheet" href="/jach/css/style.css">
    <link rel="stylesheet" href="/jach/css/bootstrap.min.css">
    <link rel="stylesheet" href="/jach/js/script.js">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light " style="background-color: #ffffff!important;" >
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
<div><h5 class="Titulo">Reservas</h5></div>
<br><br>
<form class="col-md-6">
    <div class="row">
        <div class="col">
            <input class="buttonPesquisar" type="text" id="myInput" onkeyup="myFunction()" placeholder="Nome...">
            <input class="buttonPesquisar2" type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Apelido...">
        </div>
    </div>
</form>
<br>
<br>
<table class="table table-bordered table-light tabela" id="tabela">
    <thead>
    <tr>
        <th scope="col">Nome</th>
        <th scope="col">Apelido</th>
        <th scope="col">Quarto</th>
        <th scope="col">+</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($reservas as $reserva){ ?>
        <tr>
            <td ><?=$reserva['nome']?></td>
            <td ><?=$reserva['apelido']?></td>
            <td ><?php if($reserva['idTipoQuarto']==1){
                    echo 'Pequeno';
                }else{
                    if($reserva['idTipoQuarto']==2) {
                        echo 'Medio';
                    } else {
                        echo 'Grande';
                    }
                } ?>
            </td>
            <td><a href="./check-in.php?id=<?=$reserva['id']?>" class="btn btn-warning">Check-in</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<script>

    function myFunction() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("tabela");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function myFunction2() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput2");
        filter = input.value.toUpperCase();
        table = document.getElementById("tabela");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

</script>

<script src="./js/jquery-3.3.1.min.js"></script>
<script src="./js/bootstrap.js"></script>

</body>
</html>