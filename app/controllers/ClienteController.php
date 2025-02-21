<?php
require_once(__DIR__ . '/../Model/ClienteModel.php');

class ClienteController {
    private $db;
    private $cliente;

    public function __construct($db) {
        $this->db = $db;
        $this->cliente = new Cliente($db);
    }

    public function crearCliente() {
        $mensaje = ''; 
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->cliente->dni = isset($_POST['dni']) ? $_POST['dni'] : '';
            $this->cliente->nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $this->cliente->apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
            $this->cliente->telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
            $this->cliente->email = isset($_POST['email']) ? $_POST['email'] : '';
    
            if (!empty($this->cliente->dni) && !empty($this->cliente->nombre) && !empty($this->cliente->apellido)) {
                $resultado = $this->cliente->crearCliente();
    
                    if ($resultado === true) {
                    $mensaje = "Cliente creado con éxito.";
    
                    echo "<script>document.getElementById('formCrearCliente').reset();</script>";
    
                } else {
                    $mensaje = $resultado;
                }
            } else {
                $mensaje = "Por favor, rellena todos los campos obligatorios.";
            }
        }
    
        echo "<div id='mensaje'>$mensaje</div>";
    }
    

    public function modificarCliente() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $this->cliente->dni = isset($_POST['dni']) ? $_POST['dni'] : '';
            $this->cliente->nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $this->cliente->apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
            $this->cliente->telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
            $this->cliente->email = isset($_POST['email']) ? $_POST['email'] : '';
            
            // Verificar que el DNI no esté vacío
            if (!empty($this->cliente->dni)) {
                if ($this->cliente->modificarCliente()) {
                    echo "¡Cliente actualizado con éxito!";
                } else {
                    echo "No existe el cliente con el DNI proporcionado.";
                }
            } else {
                echo "Falta el DNI del cliente.";
            }
        } else {
            // Si el método de solicitud no es POST
            echo "Método de solicitud no permitido.";
        }
    }


    public function eliminarCliente($dni) {
        $this->cliente->dni = $dni;
    $resultado = $this->cliente->eliminarCliente();

    if ($resultado === true) {
        echo '<div class="alert alert-success">Cliente eliminado con éxito.</div>';
    } else {
        echo '<div class="alert alert-danger">' . $resultado . '</div>'; 
      }
    }
    
    public function obtenerClientes() {
        $stmt = $this->cliente->obtenerClientes();
        $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $clientes;
    }
   
}
   
?>
