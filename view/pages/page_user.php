<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}
?>
<h1>Bem-vindo, Usuário <?php echo $_SESSION['usuario_nome']; ?></h1>
<a href="../logout.php" class="btn btn-primary">Logout</a>