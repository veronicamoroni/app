<?php
class Cliente {
    private $db;
    public $table = "clientes"; 
    public $dni;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;

    public function __construct($db) {
        $this->db = $db;
    }

    
    public function crearCliente() {
        try {
            $query = "INSERT INTO " . $this->table . " (dni, nombre, apellido, telefono, email) 
                      VALUES (:dni, :nombre, :apellido, :telefono, :email)";
            $stmt = $this->db->prepare($query);
            // Limpiar los datos
            $this->dni = htmlspecialchars(strip_tags($this->dni));
            $this->nombre = htmlspecialchars(strip_tags($this->nombre));
            $this->apellido = htmlspecialchars(strip_tags($this->apellido));
            $this->telefono = htmlspecialchars(strip_tags($this->telefono));
            $this->email = htmlspecialchars(strip_tags($this->email));
            // Enlazar los parámetros
            $stmt->bindParam(':dni', $this->dni);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':apellido', $this->apellido);
            $stmt->bindParam(':telefono', $this->telefono);
            $stmt->bindParam(':email', $this->email);

            return $stmt->execute();
        } catch (PDOException $e) {
            // Manejar error de llave duplicada (dni ya existente)
            if ($e->getCode() == '23505') {  // Código de violación de unicidad
                return "El cliente con DNI " . $this->dni . " ya existe.";
            } else {
                return "Error al crear el cliente: " . $e->getMessage();
            }
        }
    }
     
    public function modificarCliente() {
        // Verificar si el cliente con el DNI proporcionado existe
        $queryVerificar = "SELECT COUNT(*) FROM clientes WHERE dni = :dni";
        $stmtVerificar = $this->db->prepare($queryVerificar);
        $stmtVerificar->bindParam(':dni', $this->dni);
        $stmtVerificar->execute();
        $result = $stmtVerificar->fetchColumn();
        // Si no se encuentra el cliente con el DNI proporcionado, retornar false
        if ($result == 0) {
            return false;
        }
        // Preparar la consulta para modificar el cliente
        $queryModificar = "UPDATE clientes 
                           SET nombre = :nombre, apellido = :apellido, telefono = :telefono, email = :email 
                           WHERE dni = :dni";
        $stmtModificar = $this->db->prepare($queryModificar);
        // Limpiar los datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->dni = htmlspecialchars(strip_tags($this->dni));
        // Enlazar los parámetros
        $stmtModificar->bindParam(':nombre', $this->nombre);
        $stmtModificar->bindParam(':apellido', $this->apellido);
        $stmtModificar->bindParam(':telefono', $this->telefono);
        $stmtModificar->bindParam(':email', $this->email);
        $stmtModificar->bindParam(':dni', $this->dni);
    
        return $stmtModificar->execute();
    }
    
    
 
    public function eliminarCliente() {
        try {
            // Comprobar si el DNI existe en la tabla clientes
            $checkStmt = $this->db->prepare("SELECT COUNT(*) FROM " . $this->table . " WHERE dni = :dni");
            $checkStmt->bindParam(':dni', $this->dni);
            $checkStmt->execute();
            if ($checkStmt->fetchColumn() == 0) {
                throw new Exception("El cliente con DNI " . $this->dni . " no existe.");
            }
            // Comprobar si existen vehículos asociados
            $vehiculosStmt = $this->db->prepare("SELECT COUNT(*) FROM vehiculos WHERE dni_cliente = :dni");
            $vehiculosStmt->bindParam(':dni', $this->dni);
            $vehiculosStmt->execute();

            if ($vehiculosStmt->fetchColumn() > 0) {
                throw new Exception("El cliente no se puede eliminar porque tiene vehículos asociados.");
            }
            // Eliminar cliente
            $stmt = $this->db->prepare("DELETE FROM " . $this->table . " WHERE dni = :dni");
            $stmt->bindParam(':dni', $this->dni);
            $stmt->execute();

            return true;
        } catch (Exception $e) {
            return $e->getMessage(); 
        }
    }
    
   
  
    public function obtenerClientes() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

}
?>
