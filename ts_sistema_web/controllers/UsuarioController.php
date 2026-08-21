<?php

require_once "config/Database.php";
require_once "models/Usuario.php"; 

class UsuarioController {

    private $db;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'administrador') {
            header("Location: index.php?action=proyectos");
            exit;
        }

        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function index() {
        $query = "SELECT id, username, rol FROM usuarios ORDER BY id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once "views/layouts/header.php";
        require_once "views/usuarios/index.php";
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = isset($_POST['username']) ? trim($_POST['username']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';
            $rol = isset($_POST['rol']) ? $_POST['rol'] : 'empleado';

            if (!empty($username) && !empty($password)) {
                $query = "INSERT INTO usuarios (username, password, rol) VALUES (:username, :password, :rol)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password); 
                $stmt->bindParam(':rol', $rol);

                if ($stmt->execute()) {
                    header("Location: index.php?action=usuarios");
                    exit;
                }
            }
        }

        require_once "views/layouts/header.php";
        require_once "views/usuarios/crear.php";
    }

    public function eliminar() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        if ($id > 0) {
            $query_check = "SELECT username FROM usuarios WHERE id = :id";
            $stmt_check = $this->db->prepare($query_check);
            $stmt_check->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt_check->execute();
            $user_to_delete = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if ($user_to_delete && $user_to_delete['username'] !== $_SESSION['usuario']['username']) {
                $query = "DELETE FROM usuarios WHERE id = :id";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
            }
        }
        
        header("Location: index.php?action=usuarios");
        exit;
    }
}
?>