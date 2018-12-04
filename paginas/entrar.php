<?php
    require_once '../php/bd.php';
    require_once './parciais/head1.html';
?>
    <title>Entrar | JACH</title>
<?php
    require_once './parciais/head2.php';
?>
    <div class="row conteudo">
        <div class="col-md-4 offset-md-4 col-12">
            <?php if(isset($_SESSION['erroEntrar'])){ ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Erro</strong> O número de aluguer ou palavra-passe que inseriu está incorreto.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } unset ($_SESSION['erroEntrar']); ?>
            <h3>Entrar</h3>
            <form action="/php/entrarBD.php" method="post">
                <div class="form-group">
                    <label for="inputNumeroAluguer">Número de Aluguer:</label>
                    <input type="number" class="form-control" id="inputNumeroAluguer" name="inputNumeroAluguer">
                    <small id="emailHelp" class="form-text text-muted">Número de aluguer que recebeu no check-in</small>
                </div>
                <div class="form-group">
                    <label for="inputPalavraPasse">Palavra-passe:</label>
                    <input type="password" class="form-control" id="inputPalavraPasse" name="inputPalavraPasse">
                </div>
                <button type="submit" class="btn btn-warning">Entrar</button>
            </form>
        </div>
    </div>
<?php
    require_once './parciais/foot.html';
?>