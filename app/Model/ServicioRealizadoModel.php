<?php
class ServicioRealizado {
    private $db;
    public $table = "servicios_realizados"; 
    public $id;
    public $servicios_id;
    public $turnos_id;
    public $notas;

    
    public function __construct($db) {
        $this->db = $db;
    }


    public function crearServicioRealizado() {
        try {
            // Verificar si el servicio existe
            $queryServicio = "SELECT id FROM servicios WHERE id = :servicios_id";
            $stmtServicio = $this->db->prepare($queryServicio);
            $stmtServicio->bindParam(':servicios_id', $this->servicios_id);
            $stmtServicio->execute();
    
            if ($stmtServicio->rowCount() == 0) {
                return "El servicio no existe.";
            }
            // Verificar si el turno existe
            $queryTurno = "SELECT id FROM turnos WHERE id = :turnos_id";
            $stmtTurno = $this->db->prepare($queryTurno);
            $stmtTurno->bindParam(':turnos_id', $this->turnos_id);
            $stmtTurno->execute();
    
            if ($stmtTurno->rowCount() == 0) {
                return "El turno no existe.";
            }
            // Verificar si ya existe un registro con la misma combinación de servicio y turno
            $queryDuplicado = "SELECT id FROM servicios_realizados WHERE servicios_id = :servicios_id AND turnos_id = :turnos_id";
            $stmtDuplicado = $this->db->prepare($queryDuplicado);
            $stmtDuplicado->bindParam(':servicios_id', $this->servicios_id);
            $stmtDuplicado->bindParam(':turnos_id', $this->turnos_id);
            $stmtDuplicado->execute();
            if ($stmtDuplicado->rowCount() > 0) {
                return "Ya existe un servicio realizado con la misma combinación de servicio y turno.";
            }
    
            // Si todas las validaciones pasan, proceder con la inserción
            $query = "INSERT INTO " . $this->table . " (servicios_id, turnos_id, notas) VALUES (:servicios_id, :turnos_id, :notas)";
            $stmt = $this->db->prepare($query);
    
            // Limpiar los datos
            $this->servicios_id = htmlspecialchars(strip_tags($this->servicios_id));
            $this->turnos_id = htmlspecialchars(strip_tags($this->turnos_id));
            $this->notas = htmlspecialchars(strip_tags($this->notas));
    
            // Enlazar parámetros
            $stmt->bindParam(':servicios_id', $this->servicios_id);
            $stmt->bindParam(':turnos_id', $this->turnos_id);
            $stmt->bindParam(':notas', $this->notas);
    
            // Ejecutar la consulta
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return "Error al crear el registro: " . $e->getMessage();
        }
    }

    
    public function obtenerServiciosRealizados() {
        $query = "SELECT sr.id AS servicio_realizado_id, sr.notas, 
                         s.id AS servicio_id, s.descripcion AS servicio_nombre, s.costo, 
                         t.id AS turno_id, t.fecha AS fecha_turno, t.hora AS hora_turno, 
                         v.patente AS patente_vehiculo
                  FROM " . $this->table . " sr
                  JOIN servicios s ON sr.servicios_id = s.id
                  JOIN turnos t ON sr.turnos_id = t.id
                  JOIN vehiculos v ON t.patente = v.patente";
    
        $stmt = $this->db->prepare($query);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
      
    
   public function modificarServicioRealizado() {
    // Consultas y parámetros
    $queries = [
        'validar' => "SELECT sr.id FROM {$this->table} sr
                      JOIN turnos t ON t.id = :turnos_id
                      JOIN servicios s ON s.id = :servicios_id
                      WHERE sr.id = :id",

        'duplicado' => "SELECT id FROM {$this->table} 
                        WHERE servicios_id = :servicios_id 
                        AND turnos_id = :turnos_id 
                        AND id != :id"
    ];
    // Validar existencia y duplicados
    $stmtValidar = $this->db->prepare($queries['validar']);
    $stmtValidar->execute([':id' => $this->id, ':turnos_id' => $this->turnos_id, ':servicios_id' => $this->servicios_id]);
    if (!$stmtValidar->fetch()) {
        echo "El servicio realizado con ID {$this->id} no existe o el turno/servicio no es válido.";
        return false;
    }
    $stmtDuplicado = $this->db->prepare($queries['duplicado']);
    $stmtDuplicado->execute([':servicios_id' => $this->servicios_id, ':turnos_id' => $this->turnos_id, ':id' => $this->id]);

    if ($stmtDuplicado->rowCount() > 0) {
        echo "Ya existe un servicio realizado con la misma combinación de servicio y turno.";
        return false;
    }
    $queryModificar = "UPDATE {$this->table} 
                       SET notas = :notas, turnos_id = :turnos_id, servicios_id = :servicios_id
                       WHERE id = :id";
        $this->db->prepare($queryModificar)->execute([
            ':notas' => htmlspecialchars(strip_tags($this->notas)),
            ':turnos_id' => htmlspecialchars(strip_tags($this->turnos_id)),
            ':servicios_id' => htmlspecialchars(strip_tags($this->servicios_id)),
            ':id' => htmlspecialchars(strip_tags($this->id))
        ]);
        echo "Registro de servicio realizado modificado con éxito.";
        return true;
    }

    
    public function eliminarServicioRealizado() {
        try {
            $queryVerificar = "SELECT COUNT(*) FROM " . $this->table . " WHERE id = :id";
            $stmtVerificar = $this->db->prepare($queryVerificar);
            $stmtVerificar->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmtVerificar->execute();
            
            if ($stmtVerificar->fetchColumn() == 0) {
                return "El servicio realizado con ID " . $this->id . " no existe.";
            }
            $query = "DELETE FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                return "Servicio realizado eliminado con éxito.";
            }

        } catch (PDOException $e) {
            return "Error al eliminar el servicio realizado: " . $e->getMessage();
        }
    }
}
?>