<?php
    require_once './bd.php';
    session_start();
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
        for ($i = 0; $i < 4; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    $sql='SELECT * FROM hospede WHERE numeroContribuinte='.$_POST['inputContribuinte'].';';
    $result = $PDO->query($sql);
    if ($result){
        $hospede = $result->fetch(PDO::FETCH_ASSOC);
    }

    if(!empty($hospede)){
        $sql = 'INSERT INTO aluguer(numeroAcompanhantes, dataCheckOut, idHospede, idQuarto, palavraPasse) VALUES(:numeroAcompanhantes, :dataCheckOut, :idHospede, :idQuarto, :palavraPasse);';
        $stmt = $PDO->prepare($sql);
        $stmt->bindParam(':numeroAcompanhantes', testarInput($_POST['inputAcompanhantes']));
        $stmt->bindParam(':dataCheckOut', testarInput($_POST['inputDataCheckOut']));
        $stmt->bindParam(':idHospede', $hospede['id']);
        $stmt->bindParam(':idQuarto', testarInput($_POST['inputQuarto']));
        $stmt->bindParam(':palavraPasse', password_hash($palavraPasse=randomPassword(), PASSWORD_DEFAULT));
        $result = $stmt->execute();
        $aluguer=$PDO->lastInsertId();
    }
    else{
        $sql = 'INSERT INTO hospede(nome, apelido, numeroContribuinte, numeroTelemovel) VALUES(:nome, :apelido, :numeroContribuinte, :numeroTelemovel);';
        $stmt = $PDO->prepare($sql);
        $stmt->bindParam(':nome', testarInput($_POST['inputNome']));
        $stmt->bindParam(':apelido', testarInput($_POST['inputApelido']));
        $stmt->bindParam(':numeroContribuinte', testarInput($_POST['inputContribuinte']));
        $stmt->bindParam(':numeroTelemovel', testarInput($_POST['inputTelemovel']));
        $result = $stmt->execute();

        $sql = 'INSERT INTO aluguer(numeroAcompanhantes, dataCheckOut, idHospede, idQuarto, palavraPasse) VALUES(:numeroAcompanhantes, :dataCheckOut, :idHospede, :idQuarto, :palavraPasse);';
        $stmt = $PDO->prepare($sql);
        $stmt->bindParam(':numeroAcompanhantes', testarInput($_POST['inputAcompanhantes']));
        $stmt->bindParam(':dataCheckOut', testarInput($_POST['inputDataCheckOut']));
        $stmt->bindParam(':idHospede', $PDO->lastInsertId());
        $stmt->bindParam(':idQuarto', testarInput($_POST['inputQuarto']));
        $stmt->bindParam(':palavraPasse', password_hash($palavraPasse=randomPassword(), PASSWORD_DEFAULT));
        $result = $stmt->execute();
        $aluguer=$PDO->lastInsertId();
    }

    if(!empty($_POST['inputReserva'])){
        $sql = 'DELETE FROM reserva WHERE id=:idreserva';
        $stmt = $PDO->prepare($sql);
        $stmt->bindParam(':idreserva', testarInput($_POST['inputReserva']));
        $result = $stmt->execute();
    }

    $_SESSION["novoAluguer"]['id']=$aluguer;
    $_SESSION["novoAluguer"]['palavraPasse']=$palavraPasse;

    header('Location: ../paginas/checkIn.php');
    exit();