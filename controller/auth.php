<?php

require_once "../class/Usuarios.php";

class AuthController
{

    public function get()
    {
        // Redireciona para a view se tentarem acessar o controller via GET
        header("Location: ../view/index.php");
        exit;
    }

    public function post()
    {
        // 1. Verificar se os campos foram preenchidos
        if (empty($_POST['email']) || empty($_POST['senha'])) {
            header("Location: ../view/index.php?error=campos_vazios");
            exit;
        }

        $usuario = new Usuarios();

        // 2. Sanitização
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = $_POST['senha'];

        $usuario->email = $email;
        $usuario->senha = $senha;

        // 3. Tentar o Login
        if ($usuario->Login()) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            
            header("Location: ../view/pages/home.php");
        } else {

            header("Location: ../view/index.php?error=dados_invalidos");
        }
        exit;
    }
}


$auth = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth->post();
} else {
    $auth->get();
}
