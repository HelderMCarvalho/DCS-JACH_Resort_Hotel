<?php
    require_once './bd.php';
    function testarInput($dados){
        $dados=trim($dados);
        $dados=stripslashes($dados);
        $dados=htmlspecialchars($dados);
        return $dados;
    }
    if($_POST){
        session_start();
        $aluguer = testarInput($_POST['inputNumeroAluguer']);
        $palavraPasse = $_POST['inputPalavraPasse'];
        $sql = 'SELECT palavraPasse FROM aluguer WHERE id="'.$aluguer.'";';
        $result = $PDO->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if($row && password_verify($palavraPasse, $row['palavraPasse'])){
            $sql = 'SELECT id, numeroAcompanhantes, dataCheckOut, idHospede, idQuarto FROM aluguer WHERE id="'.$aluguer.'";';
            $result = $PDO->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $_SESSION['aluguerAutenticado'] = $row;
            header('Location: /');
        }else{
            unset ($_SESSION['aluguerAutenticado']);
            $_SESSION['erroEntrar'] = true;
            header('Location: ../paginas/entrar.php');
        }
    }else{
        unset ($_SESSION['aluguerAutenticado']);
        $_SESSION['erroEntrar'] = true;
        header('Location: ../paginas/entrar.php');
    }
    exit();