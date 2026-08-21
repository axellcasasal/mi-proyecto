<?php
class Proyecto {
    private $conn;
    private $table_name = "proyectos";

    public $id;
    public $id_usuario; 
    public $nombre;
    public $descripcion;
    public $fecha_inicio;
    public $estado;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function leerTodos() {
        $query = "SELECT id, nombre, descripcion, fecha_inicio, estado 
                  FROM " . $this->table_name . " 
                  WHERE id_usuario = :id_usuario 
                  ORDER BY id DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_usuario", $this->id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET id_usuario=:id_usuario, nombre=:nombre, descripcion=:descripcion, fecha_inicio=:fecha_inicio, estado=:estado";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_usuario", $this->id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":fecha_inicio", $this->fecha_inicio);
        $stmt->bindParam(":estado", $this->estado);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function leerUno($id) {
        $query = "SELECT id, nombre, descripcion, fecha_inicio, estado 
                  FROM " . $this->table_name . " 
                  WHERE id = :id AND id_usuario = :id_usuario LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario", $this->id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nombre = :nombre, descripcion = :descripcion, fecha_inicio = :fecha_inicio, estado = :estado 
                  WHERE id = :id AND id_usuario = :id_usuario";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":fecha_inicio", $this->fecha_inicio);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario", $this->id_usuario, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function eliminar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id AND id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario", $this->id_usuario, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>