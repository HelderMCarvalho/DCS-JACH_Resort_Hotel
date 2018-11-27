<?php
    session_start();
    unset($_SESSION['aluguerAutenticado']);
    session_destroy();
    header('Location: /');
    exit();