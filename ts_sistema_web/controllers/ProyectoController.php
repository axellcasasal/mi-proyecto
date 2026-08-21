<?php

require_once "config/Database.php";
require_once "models/Proyecto.php"; 

class ProyectoController {

    private $db;
    private $proyectoModelo;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $database = new Database();
        $this->db = $database->getConnection();
        $this->proyectoModelo = new Proyecto($this->db);
        
        $this->proyectoModelo->id_usuario = $_SESSION['usuario']['id_usuario'];
    }

    public function index() {
        $stmt = $this->proyectoModelo->leerTodos();
        $proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once "views/layouts/header.php";
        require_once "views/proyectos/index.php";
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->proyectoModelo->nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
            $this->proyectoModelo->descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
            $this->proyectoModelo->fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : '';
            $this->proyectoModelo->estado = isset($_POST['estado']) ? $_POST['estado'] : 'Activo';

            if ($this->proyectoModelo->crear()) {
                header("Location: index.php?action=proyectos");
                exit;
            }
        }
        
        require_once "views/layouts/header.php";
        require_once "views/proyectos/crear.php";
    }

    public function editar() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->proyectoModelo->id = $id;
            $this->proyectoModelo->nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
            $this->proyectoModelo->descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
            $this->proyectoModelo->fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : '';
            $this->proyectoModelo->estado = isset($_POST['estado']) ? $_POST['estado'] : 'Activo';

            if ($this->proyectoModelo->actualizar()) {
                header("Location: index.php?action=proyectos");
                exit;
            }
        }

        $proyecto_actual = $this->proyectoModelo->leerUno($id);

        if (!$proyecto_actual) {
            header("Location: index.php?action=proyectos");
            exit;
        }

        require_once "views/layouts/header.php";
        require_once "views/proyectos/editar.php";
    }

    public function eliminar() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        if ($id > 0) {
            $this->proyectoModelo->id = $id;
            $this->proyectoModelo->eliminar();
        }
        
        header("Location: index.php?action=proyectos");
        exit;
    }

    public function reportePDF() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['usuario']['id_usuario'])) {
            $this->proyectoModelo->id_usuario = $_SESSION['usuario']['id_usuario'];
        } else {
            header("Location: index.php?action=login");
            exit;
        }

        require_once "libs/fpdf/fpdf.php";

        $stmt = $this->proyectoModelo->leerTodos();
        $proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        
        $pdf->SetFillColor(13, 110, 253); 
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(0, 14, iconv('UTF-8', 'cp1252', 'TECNOSOLUCIONES S.A. - REPORTE DE PROYECTOS'), 0, 1, 'C', true);
        
        $pdf->Ln(4);
        $pdf->SetTextColor(100, 100, 100);
        $pdf->SetFont('Arial', 'I', 9);
        $pdf->Cell(0, 5, iconv('UTF-8', 'cp1252', 'Fecha de reporte: ' . date('d/m/Y H:i')), 0, 1, 'R');
        $pdf->Ln(8);

        $pdf->SetFillColor(240, 242, 245); 
        $pdf->SetTextColor(50, 50, 50);
        $pdf->SetFont('Arial', 'B', 10);
        
        $pdf->Cell(12, 8, 'ID', 1, 0, 'C', true);
        $pdf->Cell(55, 8, iconv('UTF-8', 'cp1252', 'Nombre del Proyecto'), 1, 0, 'L', true);
        $pdf->Cell(65, 8, iconv('UTF-8', 'cp1252', 'Descripción'), 1, 0, 'L', true);
        $pdf->Cell(30, 8, iconv('UTF-8', 'cp1252', 'Fecha Inicio'), 1, 0, 'C', true); 
        $pdf->Cell(28, 8, 'Estado', 1, 1, 'C', true);

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetTextColor(0, 0, 0);

        if (!empty($proyectos)) {
            foreach ($proyectos as $p) {
                $pdf->Cell(12, 8, $p['id'], 1, 0, 'C');
                $pdf->Cell(55, 8, iconv('UTF-8', 'cp1252', $p['nombre']), 1, 0, 'L');
                
                $desc = (strlen($p['descripcion']) > 38) ? substr($p['descripcion'], 0, 35) . '...' : $p['descripcion'];
                $pdf->Cell(65, 8, iconv('UTF-8', 'cp1252', $desc), 1, 0, 'L');
                
                $fechaFormateada = !empty($p['fecha_inicio']) ? date('d/m/Y', strtotime($p['fecha_inicio'])) : 'Sin fecha';
                $pdf->Cell(30, 8, $fechaFormateada, 1, 0, 'C');
                
                $pdf->Cell(28, 8, iconv('UTF-8', 'cp1252', $p['estado']), 1, 1, 'C');
            }
        } else {
            $pdf->Cell(190, 10, iconv('UTF-8', 'cp1252', 'No hay proyectos registrados para este usuario.'), 1, 1, 'C');
        }

        $pdf->Output('I', 'Reporte_Proyectos_TecnoSoluciones.pdf');
        exit;
    }
}
?>