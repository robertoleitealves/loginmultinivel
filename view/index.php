<!DOCTYPE html>
<?php
require_once "../db/db_connect.php";
//sessão
session_start();
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>
    <form action="../controller/auth.php" method="POST">
        <div class="info">
            <div class="data">
                <label class="form-label">Login: </label>
                <input class="form-control" type="email" name="email" id="email">
            </div>
            <div class="data">
                <label class="form-label">Senha: </label>
                <input class="form-control" type="password" name="senha" id="senha">
            </div>
            <div class="form-action">
                <button class="btn-primary" type="submit" name="entrar">Entrar</button>
                <a href="../view/pages/criarconta.php" class="btn btn-secondary">Criar Conta</a>
            </div>
        </div>
        <div>
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'campos_vazios') {
                    echo '<p style="color: red; font-weight: bold;">⚠️ Por favor, preencha todos os campos.</p>';
                } elseif ($_GET['error'] == 'dados_invalidos') {
                    echo '<p style="color: red; font-weight: bold;">❌ E-mail ou senha incorretos.</p>';
                }
            }
            ?>
        </div>
    </form>
</body>

</html>