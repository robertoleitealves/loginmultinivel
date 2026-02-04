<?php
    require_once '../../class/Usuarios.php';
    
    // Inicia a sessão aqui também se o header ainda não foi carregado
    if (session_status() === PHP_SESSION_NONE) { session_start(); }

    $email = $_GET['email'] ?? '';
    $usuarios = new Usuarios();
    $usuarios->email = $email;
    $usuarios->ListaUsuarios();

    // Verifica se retornou algum dado para evitar o erro de "index 0"
    if (isset($usuarios->dados) && count($usuarios->dados) > 0) {
        $usuario = $usuarios->dados[0];
    } else {
        header("Location: page_admin.php?error=usuario_nao_encontrado");
        exit;
    }

    include '../objetos/header.php';
    include '../objetos/sidebar.php';
?>
<body>
    <h1>Editar</h1>
    <form action="../../controller/usuario.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
        <input type="hidden" name="acao" value="editar">
        <div class="info">
            <label class="form-label">Nome: </label>
            <input class="form-control" type="text" name="nome" id="nome" value="<?php echo $usuario['nome'] ?>" required>
            <label class="form-label">Email: </label>
            <input class="form-control" type="email" name="email" id="email" value="<?php echo $usuario['email'] ?>" required>
            <label class="form-label">Senha: </label>
            <input class="form-control" type="password" name="senha" id="senha" required>
            <label class="form-label">Confirmar senha: </label>
            <input class="form-control" type="password" name="confirmsenha" id="confirmsenha" required>
            <label class="form-label">Nível de acesso: </label>
            <select class="form-control" type="password" name="nivel" id="nivel">
                <option value="user" <?php echo ($usuario['nivel'] == 'user') ? 'selected' : ''; ?>>Usuário</option>
                <option value="admin" <?php echo ($usuario['nivel'] == 'admin') ? 'selected' : ''; ?>>Administrador</option>
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