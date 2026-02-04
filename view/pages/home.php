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
                    <td><a href="editar_usuario.php?id=<?php echo $usuario['id']; ?>"
                            style="background-color: #2196F3; color: white; padding: 5px 10px; text-decoration: none; border-radius: 3px;">
                            Editar
                        </a>

                        <a href="../controller/usuario.php?acao=excluir&id=<?php echo $usuario['id']; ?>"
                            onclick="return confirm('Tem certeza que deseja excluir este usuário?');"
                            style="background-color: #f44336; color: white; padding: 5px 10px; text-decoration: none; border-radius: 3px; margin-left: 5px;">
                            Excluir
                        </a>
                    </td>
                    <td><?php echo $usuario['nome']; ?></td>
                    <td><?php echo $usuario['nome']; ?></td>
                    <td><?php echo $usuario['email']; ?></td>
                    <td><?php echo $usuario['nivel']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>