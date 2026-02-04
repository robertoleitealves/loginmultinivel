<?php require_once __DIR__ . '/../../config/config.php'; ?>
<!DOCTYPE html>
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$caminho = BASE_URL. '/css/style.css';
if (!isset($_SESSION['usuario_email'])) {
    header("Location: ../index.php?error=acesso_negado");
    exit;
}
$usuario = $_SESSION['usuario_nome'];
$nivel = ($_SESSION['usuario_nivel'] == 'user') ? "usuário" : "administrador";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Sistema PHP</title>
   <link rel="stylesheet" href="<?php echo $caminho; ?>">
   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <header>
        <h1>Bem-vindo, <?php echo $nivel." ". $usuario; ?></h1>
        <a href="../logout.php" >Logout</a>
    </header>