<?php
require_once '../../class/Usuarios.php';

session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

$user = new Usuarios();
$user->email = ($_SESSION['usuario_nivel'] == 'user') ? $_SESSION['usuario_email'] : '';
$user->ListaUsuarios();
$lista = $user->dados;
?>
<?php

include '../objetos/header.php';
include '../objetos/sidebar.php';
?>
<main class="content">
    <input type="hidden" name="rota" id="rota" value="<?php echo BASE_URL; ?>">
    <h1>Lista de Usuários</h1>

    <table border="2">
        <thead>
            <tr>
                <th>Ações</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Nível</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista as $usuario): ?>
                <tr>
                    <td>
                        <a class="btn-editar" href="editarperfil.php?email=<?php echo $usuario['email']; ?>"                            >
                            Editar
                        </a>
                    <?php if ($_SESSION['usuario_nivel'] == 'admin') {?>
                        <a class="btn-excluir" data-id="<?php echo $usuario['id']; ?>"                            >
                            Excluir
                        </a>
                        <?php }?>
                    </td>
                    <td><?php echo $usuario['nome']; ?></td>
                    <td><?php echo $usuario['email']; ?></td>
                    <td><?php echo $usuario['nivel']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<script src="<?php echo BASE_URL; ?>js/home.js"></script>