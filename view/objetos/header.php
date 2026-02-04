<?php require_once __DIR__ . '/../../config/config.php'; ?>
<!DOCTYPE html>
<?php
// Verifica se o arquivo atual está dentro da pasta 'pages'
$caminho = BASE_URL. '/css/style.css';
$usuario = $_SESSION['usuario_nome'];
$nivel = ($_SESSION['usuario_nivel'] == 'user') ? "usuário" : "administrador";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Sistema PHP</title>
   <link rel="stylesheet" href="<?php echo $caminho; ?>">
</head>
<body>
    <header>
        <h1>Bem-vindo, <?php echo $nivel." ". $usuario; ?></h1>
        <a href="../logout.php" >Logout</a>
    </header>