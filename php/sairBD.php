<?php
    session_start();
    unset($_SESSION['aluguerAutenticado']);
    header('Location: /');
    exit();