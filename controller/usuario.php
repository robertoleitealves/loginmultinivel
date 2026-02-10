<?php
require_once "../class/Usuarios.php";
class Usuario
{
    function delete()
    {
        $usuario = new Usuarios();
        $usuario->id = $_POST['id'];

        if ($usuario->ExcluirUsuario()) {
            echo "sucesso"; // O jQuery lerá isso no 'response'
        } else {
            echo "erro";
        }
        exit; // Interrompe a execução para não processar mais nada
    }
    function post()
    {
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
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                header("Location: ../view/pages/home.php");
            } else {
                // Se o login falhar por algum motivo, volta para a index
                header("Location: ../view/index.php?success=usuario_criado");
            }
        } else {
            header("Location: ../view/criarconta.php?error=erro_ao_salvar");
        }
        exit;
    }
    function put()
    {
        // 1. Verificar se todos os campos foram preenchidos
        if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['confirmsenha'])) {
            header("Location: ../view/editarconta.php?error=campos_vazios");
            exit;
        }

        // 2. Verificar se as senhas coincidem
        if ($_POST['senha'] !== $_POST['confirmsenha']) {
            header("Location: ../view/editarconta.php?error=senhas_diferentes");
            exit;
        }

        $usuario = new Usuarios();
        $usuario->id = $_POST['id'];
        $usuario->nome = $_POST['nome'];
        $usuario->email = $_POST['email'];

        // 3. Criptografar a senha (BCRYPT) para funcionar com o seu Login
        $usuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        // 4. Definir um nível padrão (ex: user) se não vier do formulário
        $usuario->nivel = $_POST['nivel'] ?? 'user';

        // 5. Chamar o método de salvar no Model
        if ($usuario->AtualizaUsuario()) {
           
                header("Location: ../view/pages/home.php");
            
        } else {
            header("Location: ../view/criarconta.php?error=erro_ao_salvar");
        }
        exit;
    }
}
$usuario = new Usuario();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Se vier 'acao' via POST e for 'excluir', chama o delete
    if (isset($_POST['acao']) && $_POST['acao'] === 'put') {
        $usuario->put();
    } else if (isset($_POST['acao']) && $_POST['acao'] === 'delete') {
        $usuario->delete();
    } else {
        $usuario->post();
    }
}
