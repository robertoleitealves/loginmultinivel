<?php
require_once "../class/Usuarios.php"; 
class Usuario {
public function post() {
    // 1. Verificar se todos os campos foram preenchidos
    if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['confirmsenha'])) {
        header("Location: ../view/criarconta.php?error=campos_vazios");
        exit;
    }

    // 2. Verificar se as senhas coincidem
    if ($_POST['senha'] !== $_POST['confirmsenha']) {
        header("Location: ../view/criarconta.php?error=senhas_diferentes");
        exit;
    }

    $usuario = new Usuarios();
    $usuario->nome = $_POST['nome'];
    $usuario->email = $_POST['email']; 
    
    // 3. Criptografar a senha (BCRYPT) para funcionar com o seu Login
    $usuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    
    // 4. Definir um nível padrão (ex: user) se não vier do formulário
    $usuario->nivel = $_POST['nivel'] ?? 'user';

    // 5. Chamar o método de salvar no Model
    if ($usuario->NovoUsuario()) {
    if ($usuario->Login()) {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        if ($usuario->nivel === 'admin') {
            header("Location: ../view/pages/page_admin.php");
        } else {
            header("Location: ../view/pages/page_user.php");
        }
    } else {
        // Se o login falhar por algum motivo, volta para a index
        header("Location: ../view/index.php?success=usuario_criado");
    }
} else {
    header("Location: ../view/criarconta.php?error=erro_ao_salvar");
}
exit;
}
}
$usuario = new Usuario();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario->post();
} 
// else {
//     $usuario->get();
// }
?>