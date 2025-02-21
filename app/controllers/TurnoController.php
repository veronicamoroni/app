<?php

include_once(__DIR__ . '/../Model/TurnoModel.php');  

class TurnoController {
    private $db;
    public $turno;

    public function __construct($db) {
        $this->db = $db;
        $this->turno = new Turno($this->db); 
    }


    public function crearTurno() {
        $mensaje = ''; 

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->turno->fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
            $this->turno->hora = isset($_POST['hora']) ? $_POST['hora'] : '';
            $this->turno->descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
            $this->turno->patente = isset($_POST['patente']) ? $_POST['patente'] : '';
            // Llamar al método del modelo para crear el turno
            $result = $this->turno->crearTurno();
            if ($result === true) {
                $mensaje = "¡Turno creado con éxito!";
            } else {
                $mensaje = $result; 
            }
        } else {
            $mensaje = "Método de solicitud no permitido.";
        }
        echo $mensaje;
    }

    
    public function obtenerTurnos() {
        $stmt = $this->turno->obtenerTurnos();
        $turnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // convertir la fecha al formato dd-mm-aaaa
        foreach ($turnos as &$turno) {
            $turno['fecha'] = date('d-m-Y', strtotime($turno['fecha']));
        }
        return $turnos;
    }
        
   
    public function eliminarTurno() {
        if (isset($_POST['id'])) {
        $id = $_POST['id'];
        // Asignar el ID del turno al modelo
        $this->turno->id = $id;
        // Llamar al método del modelo y almacenar el mensaje de respuesta
        $mensaje = $this->turno->eliminarTurno();
        echo $mensaje;
    } else {
        echo "ID del turno no proporcionado.";
    }
}


     public function modificarTurno() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->turno->id = isset($_POST['id']) ? $_POST['id'] : '';
            $this->turno->fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
            $this->turno->hora = isset($_POST['hora']) ? $_POST['hora'] : '';
            $this->turno->descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
            $this->turno->patente = isset($_POST['patente']) ? $_POST['patente'] : '';
            // Verificar que el ID no esté vacío
            if (!empty($this->turno->id)) {
                // Llamar al método del modelo para modificar el turno
                if ($this->turno->modificarTurno()) {
                    echo "¡Turno actualizado con éxito!";
                } else {
                    echo "No existe un turno con el ID proporcionado.";
                }
            } else {
                echo "Falta el ID del turno.";
            }
        } else {
            echo "Método de solicitud no permitido.";
        }
    }
    
}

?>
