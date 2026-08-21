<?php

require_once "config/Database.php";
require_once "models/OrdenTrabajo.php"; 

class OrdenTrabajoController {

    private $db;
    private $ordenModelo;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['personal_planta'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $database = new Database();
        $this->db = $database->getConnection();
        $this->ordenModelo = new OrdenTrabajo($this->db);
    }

    public function index() {
        $stmt = $this->ordenModelo->listar();
        $ordenes_mantenimiento = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once "views/ordenes/panel_control.php"; 
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->ordenModelo->codigo_maquina    = $_POST['codigo_maquina'];
            $this->ordenModelo->tipo_intervencion = $_POST['tipo_intervencion']; 
            $this->ordenModelo->fecha_programada  = $_POST['fecha_programada'];
            $this->ordenModelo->fecha_limite      = $_POST['fecha_limite'];

            if ($this->ordenModelo->insertarOrden()) {
                header("Location: index.php?action=ordenes");
                exit;
            }
        }

        require_once "views/ordenes/nueva_orden.php";
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->ordenModelo->id_orden          = $_POST['id_orden'];
            $this->ordenModelo->codigo_maquina    = $_POST['codigo_maquina'];
            $this->ordenModelo->tipo_intervencion = $_POST['tipo_intervencion'];
            $this->ordenModelo->fecha_programada  = $_POST['fecha_programada'];
            $this->ordenModelo->fecha_limite      = $_POST['fecha_limite'];

            if ($this->ordenModelo->modificarOrden()) {
                header("Location: index.php?action=ordenes");
                exit;
            }
        } else {
            $orden = $this->ordenModelo->buscarPorId($_GET['id']);
            require_once "views/ordenes/modificar_orden.php";
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->ordenModelo->removerOrden($_GET['id']);
        }
        header("Location: index.php?action=ordenes");
        exit;
    }
}
?>