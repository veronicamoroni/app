<?php

include_once(__DIR__ . '/../Model/VehiculoModel.php');


class VehiculoController {
    private $db;
    public $vehiculo;
    private $table = "vehiculos"; 

    public function __construct($db) {
        $this->db = $db;
        $this->vehiculo = new Vehiculo($this->db);  
    }
    public function crearVehiculo() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->vehiculo->patente = isset($_POST['patente']) ? $_POST['patente'] : '';
            $this->vehiculo->marca = isset($_POST['marca']) ? $_POST['marca'] : '';
            $this->vehiculo->modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
            $this->vehiculo->dni_cliente = isset($_POST['dni_cliente']) ? $_POST['dni_cliente'] : '';
            
            $query = "SELECT COUNT(*) FROM vehiculos WHERE patente = :patente";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':patente', $this->vehiculo->patente);
            $stmt->execute();
            $result = $stmt->fetchColumn();
            // Si la patente ya existe, detener el proceso y mostrar el mensaje
            if ($result > 0) {
                echo "La patente ingresada ya está registrada. Por favor, verifica los datos e intenta nuevamente.";
                return;
            }
            // Validar que los campos obligatorios no estén vacíos
            if (!empty($this->vehiculo->patente) && !empty($this->vehiculo->marca) && !empty($this->vehiculo->modelo)) {
                try {
                    $query = "INSERT INTO vehiculos (patente, marca, modelo, dni_cliente) VALUES (:patente, :marca, :modelo, :dni_cliente)";
                    $stmt = $this->db->prepare($query);
                    // Enlace de parámetros
                    $stmt->bindParam(':patente', $this->vehiculo->patente);
                    $stmt->bindParam(':marca', $this->vehiculo->marca);
                    $stmt->bindParam(':modelo', $this->vehiculo->modelo);
                    $stmt->bindParam(':dni_cliente', $this->vehiculo->dni_cliente);
                    if ($stmt->execute()) {
                        echo "¡Vehículo creado con éxito!";
                    } else {
                        echo "Hubo un problema al crear el vehículo. Por favor, inténtalo nuevamente.";
                    }
                } catch (PDOException $e) {
                    // Capturar errores específicos de la base de datos
                    if ($e->getCode() == '23505') {
                        echo "La patente ingresada ya está registrada. Por favor, verifica los datos e intenta nuevamente.";
                    } else {
                        echo "No se puede crear el Vehículo.";
                    }
                }
            } else {
                echo "Por favor, completa todos los campos obligatorios antes de continuar.";
            }
        }
    }


    public function modificarVehiculo() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->vehiculo->patente = $_POST['patente'] ?? '';
            $this->vehiculo->nueva_patente = $_POST['nueva_patente'] ?? $this->vehiculo->patente;
            $this->vehiculo->marca = $_POST['marca'] ?? '';
            $this->vehiculo->modelo = $_POST['modelo'] ?? '';
            $this->vehiculo->dni_cliente = $_POST['dni_cliente'] ?? '';
    
            // Verificar que la patente no esté vacía
            if (!empty($this->vehiculo->patente)) {
                // Llamar al método del modelo para modificar el vehículo
                $resultado = $this->vehiculo->modificarVehiculo();
    
                if ($resultado === "Vehículo modificado correctamente.") {
                    echo "<div class='alert alert-success'>$resultado</div>";
                } else {
                    echo "<div class='alert alert-danger'>$resultado</div>";
                }
            } else {
                echo "<div class='alert alert-warning'>Falta la patente del vehículo.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Método de solicitud no permitido.</div>";
        }
    }
    

    public function eliminarVehiculo($patente) {
        $this->vehiculo->patente = $patente;
        $mensaje = $this->vehiculo->eliminarVehiculo();
        echo $mensaje;
    }

        
    public function obtenerVehiculos() {
        $stmt = $this->vehiculo->obtenerVehiculos(); 
        $vehiculos = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $vehiculos;
    }
    
}