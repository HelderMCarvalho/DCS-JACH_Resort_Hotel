<?php
    define('MYSQL_HOST', 'localhost');
    define('MYSQL_USER', 'root');
    define('MYSQL_PASSWORD', 'mysql');
    define('MYSQL_DB_NAME', 'jach');
    try{
        $PDO = new PDO('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD);
        $PDO->exec('set names utf8');
    }catch (PDOException $e){
        echo 'Erro ao conectar com o MySQL: '.$e->getMessage();
    }