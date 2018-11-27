<?php
    require_once './bd.php';
    session_start();
    if($_POST){
        if(empty($_POST["nome"])){
            $nome_Erro="O Nome é um campo obrigatório";
        }else{
        $nome = test_input($_POST["nome"]);
        }
    }
    if($_POST){
        if(empty($_POST["apelido"])){
            $apelido_Erro="Apelido é um campo obrigatório";
        }else{
        $apelido = test_input($_POST["apelido"]);
        }
    }
    if($_POST){
        if(empty($_POST["numero"])){
            $numero_Erro="O número é um campo obrigatório";
        }else{
        $numero = test_input($_POST["numero"]);
        }
    }
    $acompanhantes = test_input($_POST["acompanhantes"]);
    if($_POST){
        if(empty($_POST["startDate"])){
            $startDate_Erro="Data de check-in é um campo obrigatório";
        }else{
        $startDate = test_input($_POST["startDate"]);
        }
    }
    if($_POST){
        if(empty($_POST["endDate"])){
            $endDate_Erro="Data de check-out é um campo obrigatório";
        }else{
        $endDate = test_input($_POST["endDate"]);
        }
    }
    if(!empty($nome_Erro) || !empty($apelido_Erro) || !empty($numero_Erro) || !empty($startDate_Erro) || !empty($endDate_Erro)){
        ?>
          <h2>Erros:</h2>
          <ul>
              <li><?echo $nome_Erro;?></li>
              <li><?echo $apelido_Erro;?></li>
              <li><?echo $numero_Erro;?></li>
              <li><?echo $startDate_Erro;?></li>
              <li><?echo $endDate_Erro;?></li>
              
          </ul>
          <?php
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $inicio='"'.str_replace("/","-",$startDate).'"';
    $fim='"'.str_replace("/","-",$endDate).'"';
    
    $idTipoQuartoIF=$_POST["idTipoQuarto"]; 
    $sql='SELECT COUNT(*) AS contagemReservas FROM reserva WHERE (idTipoQuarto='.$idTipoQuartoIF.') AND ((dataCheckIn BETWEEN '.$inicio.' AND '.$fim.') OR (dataCheckOut BETWEEN '.$inicio.' AND '.$fim.') OR ('.$inicio.' >= dataCheckIn AND '.$fim.' <= dataCheckOut))';
    $resultReservas = $PDO->query($sql);
    $resultReservas = $resultReservas->fetch(PDO::FETCH_ASSOC);

    $sql='SELECT COUNT(*) AS contagemQuartos FROM quarto WHERE idTipoQuarto='.$idTipoQuartoIF.';';
    $resultQuartos = $PDO->query($sql);
    $resultQuartos = $resultQuartos->fetch(PDO::FETCH_ASSOC);

    if($resultReservas['contagemReservas'] < $resultQuartos['contagemQuartos']){
        $sql = 'INSERT INTO reserva(nome,apelido,numeroTelemovel,numeroAcompanhantes,dataCheckIn,dataCheckOut,idTipoQuarto) VALUES(:nome, :apelido, :numeroTelemovel, :numeroAcompanhantes, :dataCheckIn, :dataCheckOut,:idTipoQuarto);';
        $stmt = $PDO->prepare($sql);
        $nome=$_POST["nome"];
        $apelido=$_POST["apelido"];
        $numero=$_POST["numero"];
        $acompanhantes=$_POST["acompanhantes"];
        $dataCheckIN=$_POST["startDate"];
        $dataCheckOUT=$_POST["endDate"];
        $idTipoQuarto=$_POST["idTipoQuarto"];
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':apelido', $apelido);
        $stmt->bindParam(':numeroTelemovel', $numero);
        $stmt->bindParam(':numeroAcompanhantes', $acompanhantes);        
        $stmt->bindParam(':dataCheckIn',  $dataCheckIN);
        $stmt->bindParam(':dataCheckOut', $dataCheckOUT);
        $stmt->bindParam(':idTipoQuarto', $idTipoQuarto);
        $result = $stmt->execute();
        
        $_SESSION["reserva"] = true;
        $url = '/paginas/reservarQuarto.php?idTipoQuarto='.$idTipoQuartoIF;
        header("Location: $url");
    }else{
        echo 'cheio';
        $_SESSION["reserva"] = false;
        $url = '/paginas/reservarQuarto.php?idTipoQuarto='.$idTipoQuartoIF;
        header("Location: $url");
    }
    exit();
?>