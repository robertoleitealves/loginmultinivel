<aside class="sidebar">
    <nav>
        <ul>
            <li><a href="<?php echo BASE_URL; ?>view/pages/home.php">Home</a></li>
            <?php if ($_SESSION['usuario_nivel'] == 'admin') {?>
            <li><a href="<?php echo BASE_URL; ?>view/pages/page_admin.php">Admin</a></li>
            <?php }?>
            <li><a href="<?php echo BASE_URL; ?>view/pages/page_user.php">Usuário</a></li>
            <li><a href="<?php echo BASE_URL; ?>view/logout.php">Sair</a></li>
        </ul>
    </nav>
</aside>
<main class="content">