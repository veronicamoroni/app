<?php
require_once './Model/ServicioModel.php';

class ServicioController {
    private $db;
    private $servicio;

    
    public function __construct($db) {
        $this->db = $db;
        $this->servicio = new Servicio($this->db);
    }

    public function crearServicio() {
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
        $costo = isset($_POST['costo']) ? $_POST['costo'] : null;
    
        if (empty($descripcion) || empty($costo)) {
            // Validación en caso de que los campos sean vacíos
            echo "Descripción y costo son obligatorios.";
            return;
        }
          // Crear un nuevo servicio
        $this->servicio->descripcion = $descripcion;
        $this->servicio->costo = $costo;
    
        if ($this->servicio->crearServicio()) {
            echo "Servicio creado exitosamente.";
        } else {
            echo "El servicio ya existe en la base de datos.";
        }
    }

    
    public function modificarServicio() {
        $this->servicio->id = $_POST['id'];
        $this->servicio->descripcion = $_POST['descripcion'];
        $this->servicio->costo = $_POST['costo'];
    
        if ($this->servicio->modificarServicio()) {
            echo "Servicio modificado con éxito.";
        } else {
            echo "El servicio No existe.";
        }
    }


    public function eliminarServicio() {
        // Verificar si el ID del servicio se pasa por POST
        if (isset($_POST['id'])) {
            $id = $_POST['id']; 
            $this->servicio->id = $id; // Asigno el ID al objeto del modelo Servicio
    
            $mensaje = $this->servicio->eliminarServicio();
    
            echo $mensaje;
        } else {
            echo "Falta el ID del servicio.";
        }
    }
    

    public function listarServicios() {
        // Obtener todos los servicios
        $stmt = $this->servicio->obtenerServicios();
        $servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        global $smarty;
        $smarty->assign('servicios', $servicios);
        $smarty->display('listarServicios.tpl');  
    }

}
?>
