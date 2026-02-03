<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_nivel'] !== 'admin') {
    header("Location: ../index.php");
    exit;
}
?>
<h1>Bem-vindo, Administrador <?php echo $_SESSION['usuario_nome']; ?></h1>
