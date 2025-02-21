<?php
class Servicio {
    private $db;
    public $table = "servicios"; 
    public $id;
    public $descripcion;
    public $costo;

    
    public function __construct($db) {
        $this->db = $db;
    }


    public function crearServicio() {
        try {
            // Verificar si el servicio ya existe
            $query = "SELECT COUNT(*) FROM " . $this->table . " WHERE descripcion = :descripcion";
            $stmt = $this->db->prepare($query);
            // Limpiar los datos
            $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
            $descripcion = $this->descripcion;
            // Enlazar el parámetro
            $stmt->bindParam(':descripcion', $descripcion);
           // Ejecutar la consulta
            $stmt->execute();
            // Verificar si el servicio ya existe
            $count = $stmt->fetchColumn();
            if ($count > 0) {
                // Si el servicio ya existe, retornar false
                return false;
            }
            // Si no existe, realizar la inserción del nuevo servicio
            $query = "INSERT INTO " . $this->table . " (descripcion, costo) VALUES (:descripcion, :costo)";
            $stmt = $this->db->prepare($query);
            // Limpiar y enlazar los parámetros
            $this->costo = htmlspecialchars(strip_tags($this->costo));
            $stmt->bindParam(':descripcion', $this->descripcion);
            $stmt->bindParam(':costo', $this->costo);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            return "Error al crear el servicio: " . $e->getMessage();
        }
    }
    

    public function modificarServicio() {
        // Verificar si el servicio con el ID proporcionado existe
        $queryVerificar = "SELECT COUNT(*) FROM servicios WHERE id = :id";
        $stmtVerificar = $this->db->prepare($queryVerificar);
        $stmtVerificar->bindParam(':id', $this->id);
        $stmtVerificar->execute();
        $result = $stmtVerificar->fetchColumn();
        // Si no se encuentra el servicio con el ID proporcionado, retornar false
        if ($result == 0) {
            return false; 
        }
        // Si el servicio existe, proceder con la actualización
        $query = "UPDATE servicios 
                SET descripcion = :descripcion, costo = :costo
                WHERE id = :id";
       
        $stmt = $this->db->prepare($query);
        // Limpiar los datos 
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->costo = htmlspecialchars(strip_tags($this->costo));
        $this->id = htmlspecialchars(strip_tags($this->id));
          // Enlazar los parámetros
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':costo', $this->costo);
    
        return $stmt->execute();
    }
    
    
    public function eliminarServicio() {
        try {
            $queryVerificar = "SELECT COUNT(*) FROM servicios WHERE id = :id";
            $stmtVerificar = $this->db->prepare($queryVerificar);
            $stmtVerificar->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmtVerificar->execute();
            if ($stmtVerificar->fetchColumn() == 0) {
                return "El servicio con ID " . $this->id . " no existe.";
            }
            
            $query = "DELETE FROM servicios WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);          
            if ($stmt->execute()) {
               
                if ($stmt->rowCount() > 0) {
                    return "Servicio eliminado con éxito.";
                } else {
                    return "No se pudo eliminar el servicio. Puede que ya haya sido eliminado.";
                }
            } else {
                return "Error: No se pudo eliminar el servicio.";
            }
    
        } catch (PDOException $e) {
            if ($e->getCode() == '23503') { 
                return "No se puede eliminar el servicio porque está vinculado a otra tabla.";
            }
            return "Error al eliminar el servicio: " . $e->getMessage();
        }
    }
    
    
    public function obtenerServicios() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
}
?>
