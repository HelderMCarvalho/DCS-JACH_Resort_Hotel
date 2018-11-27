<?php
    require_once './php/bd.php';
    require_once './paginas/parciais/head1.html';
?>
    <title>Início | JACH</title>
<?php
    require_once './paginas/parciais/head2.php';
?>
    <div class="row conteudo">
        <div class="col-md-4 offset-md-4 col-12">
            <h3>Início</h3>
        </div>
    </div>
<?php
    echo var_dump($_SESSION['aluguerAutenticado']);
    require_once './paginas/parciais/foot.html';
?>