<?php

class Vehiculo {
    private $db;
    public $patente;
    public $marca;
    public $modelo;
    public $dni_cliente;
    public $table = "vehiculos"; 

    public function __construct($db) {
        $this->db = $db;
    }

    
    public function crearVehiculo() { 
        $query = "SELECT COUNT(*) FROM vehiculos WHERE patente = :patente";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':patente', $this->patente);
        $stmt->execute();
        $result = $stmt->fetchColumn();
    
        if ($result > 0) {
            return "Error: La patente ya está registrada.";
        }
    
        $query = "INSERT INTO vehiculos (patente, marca, modelo, dni_cliente) VALUES (:patente, :marca, :modelo, :dni_cliente)";
        $stmt = $this->db->prepare($query);
    
        // Enlace de parámetros
        $stmt->bindParam(':patente', $this->patente);
        $stmt->bindParam(':marca', $this->marca);
        $stmt->bindParam(':modelo', $this->modelo);
        $stmt->bindParam(':dni_cliente', $this->dni_cliente);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return "Error: No se pudo crear el vehículo.";
        }
    }


    public function modificarVehiculo() {
        try {
            // Verificar si el vehículo con la patente original existe
            $queryVerificar = "SELECT COUNT(*) FROM vehiculos WHERE patente = :patente";
            $stmtVerificar = $this->db->prepare($queryVerificar);
            $stmtVerificar->bindParam(':patente', $this->patente);
            $stmtVerificar->execute();
            $result = $stmtVerificar->fetchColumn();
    
            if ($result == 0) {
                return "El vehículo con la patente especificada no existe.";
            }
    
            // Verificar si la nueva patente ya existe (y es diferente a la patente actual)
            if ($this->patente !== $this->nueva_patente) {
                $queryVerificarNuevaPatente = "SELECT COUNT(*) FROM vehiculos WHERE patente = :nueva_patente";
                $stmtVerificarNuevaPatente = $this->db->prepare($queryVerificarNuevaPatente);
                $stmtVerificarNuevaPatente->bindParam(':nueva_patente', $this->nueva_patente);
                $stmtVerificarNuevaPatente->execute();
                $nuevaPatenteExiste = $stmtVerificarNuevaPatente->fetchColumn();
    
                if ($nuevaPatenteExiste > 0) {
                    return "La nueva patente ya está en uso por otro vehículo.";
                }
            }
    
            $query = "UPDATE vehiculos 
                      SET patente = :nueva_patente, marca = :marca, modelo = :modelo, dni_cliente = :dni_cliente 
                      WHERE patente = :patente";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':patente', $this->patente);
            $stmt->bindParam(':nueva_patente', $this->nueva_patente);
            $stmt->bindParam(':marca', $this->marca);
            $stmt->bindParam(':modelo', $this->modelo);
            $stmt->bindParam(':dni_cliente', $this->dni_cliente);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                return "Vehículo modificado correctamente.";
            } else {
                return "No se realizaron cambios en el vehículo.";
            }
        } catch (PDOException $e) {
            // Si ocurre un error por clave foránea (turnos asociados)
            if ($e->getCode() == "23503" || $e->getCode() == "1451") { 
                return "No se puede modificar el vehículo.";
            }
            // Si ocurre un error de duplicidad (nueva patente ya existe)
            if ($e->getCode() == "23505") {
                return "No se puede modificar el vehículo porque la nueva patente ya está en uso.";
            }
            return "Error en la base de datos: " . $e->getMessage();
        }
    }
    
    
    

    public function eliminarVehiculo() {
        try {
            $queryVerificar = "SELECT COUNT(*) FROM vehiculos WHERE patente = :patente";
            $stmtVerificar = $this->db->prepare($queryVerificar);
            $stmtVerificar->bindParam(':patente', $this->patente);
            $stmtVerificar->execute();
            $result = $stmtVerificar->fetchColumn();

            if ($result == 0) {
                return "El vehículo con la patente proporcionada no existe.";
            }

            $query = "DELETE FROM vehiculos WHERE patente = :patente";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':patente', $this->patente);
            
            if ($stmt->execute()) {
                return "Vehículo eliminado con éxito.";
            }

        } catch (PDOException $e) {
            if ($e->getCode() == '23503') { 
                return "No se puede eliminar el vehículo porque tiene turnos asociados.";
            }
            return "Error al eliminar el vehículo: " . $e->getMessage();
        }
    }


     
    public function obtenerVehiculos() {
        $query = "SELECT * FROM " . $this->table; 
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>