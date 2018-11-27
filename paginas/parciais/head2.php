    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/css/style.css" type="text/css">
</head>
<?php session_start(); ?>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <a class="navbar-brand" href="/"><h1 class="titulo">JACH Resort Hotel</h1></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item <?php if(($_SERVER['REQUEST_URI']=='/index.php') || ($_SERVER['REQUEST_URI']=='/')){echo 'active';} ?>">
                            <a class="nav-link" href="/">Início<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/paginas/reservarQuarto.php?idTipoQuarto=1">Quartos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Contactos</a>
                        </li>
                        <li class="nav-item <?php if($_SERVER['REQUEST_URI']=='/paginas/entrar.php'){echo 'active';} ?>">
                            <?php if(!isset($_SESSION['aluguerAutenticado'])){ ?>
                                    <a class="nav-link btn btn-warning" href="/paginas/entrar.php">Entrar</a>
                            <?php } else{ ?>
                                <a class="nav-link btn btn-warning" href="/php/sairBD.php">Sair</a>
                            <?php }?>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>