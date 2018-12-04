<?php
require_once('./bd.php');

    function testarInput($dados){
        $dados=trim($dados);
        $dados=stripslashes($dados);
        $dados=htmlspecialchars($dados);
        return $dados;
    }

    /* Funcao para criar palavra-passe random*/
    function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


    $stmt = $PDO->prepare($sql);
    echo var_dump($_POST['inputNome'])."<br>";
    echo var_dump($_POST['inputApelido'])."<br>";
    echo var_dump($_POST['inputContribuinte'])."<br>";
    echo var_dump($_POST['inputTelemovel'])."<br>";

    $sql = 'INSERT INTO hospede(nome,apelido,numeroContribuinte,numeroTelemovel) VALUES(:nome, :apelido, :numeroContribuinte, :numeroTelemovel);';
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':nome', testarInput($_POST['inputNome']));
    $stmt->bindParam(':apelido', testarInput($_POST['inputApelido']));
    $stmt->bindParam(':numeroContribuinte', testarInput($_POST['inputContribuinte']));
    $stmt->bindParam(':numeroTelemovel', testarInput($_POST['inputTelemovel']));



    $pass = randomPassword();
    /*var_dump($pass);
    var_dump($_POST['inputAcompanhantes'])."<br>";
    var_dump($_POST['inputdataChecktOut'])."<br>";
*/


    $result = $stmt->execute();

    $sql = 'INSERT INTO aluguer(numeroAcompanhantes,dataCheckOut,idHospede,idQuarto,palavraPasse) VALUES(:numeroAcompanhante, :dataChecktOut, :idHospede, :idQuarto, :palavraPasse);';
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':numeroAcompanhante', testarInput($_POST['inputAcompanhantes']));
    $stmt->bindParam(':dataChecktOut', testarInput($_POST['inputdataCheckOut']));
    $stmt->bindParam(':idHospede', testarInput('1'));
    $stmt->bindParam(':idQuarto', testarInput('1'));
    $stmt->bindParam(':palavraPasse', testarInput($pass));
    $result = $stmt->execute();



    $sql = 'DELETE FROM reserva WHERE reserva.id=:idreserva';
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':idreserva', testarInput($_POST['idreserva']));
    $result = $stmt->execute();


    header("Location: /jach/reservas.php");
    exit();

//Quartos Ocupados
//SELECT * FROM reserva WHERE reserva.idTipoQuarto = 1 AND ( reserva.dataCheckIn BETWEEN '2018-11-4' AND '2018-11-15' OR reserva.dataCheckOut BETWEEN '2018-11-4' AND '2018-11-15' OR (reserva.dataCheckIn <= '2018-11-4' AND reserva.dataCheckOut >= '2018-11-15' ) )