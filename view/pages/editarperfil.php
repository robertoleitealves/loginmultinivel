<?php
require_once '../../class/Usuarios.php';

// Inicia a sessão aqui também se o header ainda não foi carregado
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$email = $_GET['email'] ?? '';
$usuarios = new Usuarios();
$usuarios->email = $email;
$usuarios->ListaUsuarios();

// Verifica se retornou algum dado para evitar o erro de "index 0"
if (isset($usuarios->dados) && count($usuarios->dados) > 0) {
    $user = $usuarios->dados;
} else {
    header("Location: page_admin.php?error=usuario_nao_encontrado");
    exit;
}

include '../objetos/header.php';
include '../objetos/sidebar.php';
?>
<main class="content">
    <h1>Editar</h1>
    <form action="../../controller/usuario.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $user[0]['id']; ?>">
        <input type="hidden" name="acao" value="put">

        <div class="info">
            <label class="form-label">Nome: </label>
            <input class="form-control" type="text" name="nome" id="nome" value="<?php echo $user[0]['nome'] ?>" required>
            <label class="form-label">Email: </label>
            <input class="form-control" type="email" name="email" id="email" value="<?php echo $user[0]['email'] ?>" required>
            <label class="form-label">Senha: </label>
            <input class="form-control" type="password" name="senha" id="senha" required>
            <label class="form-label">Confirmar senha: </label>
            <input class="form-control" type="password" name="confirmsenha" id="confirmsenha" required>
            <label class="form-label">Nível de acesso: </label>
            <select class="form-control" type="password" name="nivel" id="nivel">
                <option value="user" <?php echo ($user[0]['nivel'] == 'user') ? 'selected' : ''; ?>>Usuário</option>
                <option value="admin" <?php echo ($user[0]['nivel'] == 'admin') ? 'selected' : ''; ?>>Administrador</option>
            </select>
            <div class="form-action">
                <button type="submit" class="btn-secondary" onclick="window.history.back();" name="voltar">Voltar</button>
                <button type="submit" class="btn-primary" name="confirmar">Confirmar</button>
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
</main>