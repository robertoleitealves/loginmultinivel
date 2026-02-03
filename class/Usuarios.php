<?php
class Usuarios
{
    public $id = 0;
    public $nome = '';
    public $email = '';
    public $senha = '';
    public $nivel = '';

    // public function LeUsuario()
    // {
    //     include __DIR__ . '/../db/db_connect.php';

    //     // Verificamos se a variável $connect existe após o include
    //     if (!isset($connect) || $connect === null) {
    //         die("Erro crítico: A variável de conexão \$connect não foi definida no db_connect.php");
    //     }

    //     $email = mysqli_real_escape_string($connect, $this->email);
    //     $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    //     $resultado = mysqli_query($connect, $sql);
    //     if ($resultado && $dados = mysqli_fetch_assoc($resultado)) {
    //         $this->id = $dados['id'];
    //         $this->nome = $dados['nome'];
    //         $this->nivel = $dados['nivel'];
    //     }
    // }

    public function Login()
    {
        // Usar include garante que as variáveis do arquivo sejam lidas neste escopo
        include __DIR__ . '/../db/db_connect.php';

        // Verificamos se a variável $connect existe após o include
        if (!isset($connect) || $connect === null) {
            die("Erro crítico: A variável de conexão \$connect não foi definida no db_connect.php");
        }

        $email = mysqli_real_escape_string($connect, $this->email);
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = mysqli_query($connect, $sql);

        if ($resultado && $dados = mysqli_fetch_assoc($resultado)) {
            if (password_verify($this->senha, $dados['senha'])) {
                $this->id = $dados['id'];
                $this->nome = $dados['nome'];
                $this->nivel = $dados['nivel'];

                session_start();
                $_SESSION['usuario_id'] = $this->id;
                $_SESSION['usuario_nome'] = $this->nome;
                $_SESSION['usuario_nivel'] = $this->nivel;
                return true;
            }
        }
        return false;
    }

    public function NovoUsuario()
    {
        include __DIR__ . '/../db/db_connect.php';


        // 1. Sanitização para evitar SQL Injection
        $nome = mysqli_real_escape_string($connect, $this->nome);
        $email = mysqli_real_escape_string($connect, $this->email);
        $senha = $this->senha; // Já deve vir com password_hash do Controller
        $nivel = mysqli_real_escape_string($connect, $this->nivel);

        // 2. Comando SQL
        $sql = "INSERT INTO usuarios (nome, email, senha, nivel) 
            VALUES ('$nome', '$email', '$senha', '$nivel')";

        // 3. Execução
        if (mysqli_query($connect, $sql)) {
            $this->id = mysqli_insert_id($connect);
            return true;
        } else {
            // Log de erro para o desenvolvedor
            error_log("Erro no MySQL: " . mysqli_error($connect));
            return false;
        }
    }
}
