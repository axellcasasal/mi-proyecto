<?php

require_once "config/Database.php";
require_once "models/Usuario.php"; 

class AuthController {

    private $db;
    private $usuarioModelo;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $database = new Database();
        $this->db = $database->getConnection();
        $this->usuarioModelo = new Usuario($this->db);
    }

    public function login() {
        if (isset($_SESSION['usuario'])) {
            header("Location: index.php?action=proyectos");
            exit;
        }

        $error = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = isset($_POST['username']) ? trim($_POST['username']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';

            if (!empty($username) && !empty($password)) {
                $usuario = $this->usuarioModelo->login($username, $password);

                if ($usuario) {
                   
                    $_SESSION['usuario'] = [
                        'id_usuario' => $usuario['id'],       
                        'username'   => $usuario['username'],  
                        'rol'        => $usuario['rol']       
                    ];

                    header("Location: index.php?action=proyectos");
                    exit;
                } else {
                    $error = "El usuario o la contraseña son incorrectos.";
                }
            } else {
                $error = "Por favor, llene todos los campos.";
            }
        }

        require_once "views/auth/login.php";
    }

    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }
}
?>