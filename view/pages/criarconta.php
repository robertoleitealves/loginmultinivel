<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../../css/style.css">
    <title>Nova Conta</title>
</head>

<body>
    <h1>Criar Conta</h1>
    <form action="../../controller/usuario.php" method="POST">
        <div class="info">
            <label class="form-label">Nome: </label>
            <input class="form-control" type="text" name="nome" id="nome" required>
            <label class="form-label">Email: </label>
            <input class="form-control" type="email" name="email" id="email" required>
            <label class="form-label">Senha: </label>
            <input class="form-control" type="password" name="senha" id="senha" required>
            <label class="form-label">Confirmar senha: </label>
            <input class="form-control" type="password" name="confirmsenha" id="confirmsenha" required>
            <label class="form-label">Nível de acesso: </label>
            <select class="form-control" type="password" name="nivel" id="nivel" >
                <option value="user">Usuário</option>
                <option value="admin">Administrador</option>
            </select>
            <button type="submit" name="confirmar">Confirmar</button>
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