<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Vehículo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap">
  
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

    {assign var="titulo" value="Gestión de Vehículos"}
    {include file="navbar.tpl"}

    <!-- Contenedor principal -->
    <div class="container flex-fill mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow p-4">
                    <div class="text-center mb-4">
                        <span class="material-symbols-outlined" style="font-size: 50px; color: #007bff;">directions_car</span>
                        <h3 class="mt-2">Modificar Vehículo</h3>
                    </div>

                    <!-- Formulario de modificación de vehículo -->
                    <form id="formModificarVehiculo" action="/index.php?action=modificarVehiculo" method="post">
                        <div class="form-group">
                            <label for="patente">Patente Actual:</label>
                            <input type="text" class="form-control" id="patente" name="patente" value="{if isset($vehiculo)}{$vehiculo.patente}{/if}" required>
                        </div>
                        <div class="form-group">
                            <label for="nueva_patente">Nueva Patente:</label>
                            <input type="text" class="form-control" id="nueva_patente" name="nueva_patente" placeholder="Opcional">
                        </div>
                        <div class="form-group">
                            <label for="marca">Marca:</label>
                            <input type="text" class="form-control" id="marca" name="marca" value="{if isset($vehiculo)}{$vehiculo.marca}{/if}" required>
                        </div>
                        <div class="form-group">
                            <label for="modelo">Modelo:</label>
                            <input type="text" class="form-control" id="modelo" name="modelo" value="{if isset($vehiculo)}{$vehiculo.modelo}{/if}" required>
                        </div>
                        <div class="form-group">
                            <label for="dni_cliente">DNI del Cliente:</label>
                            <input type="text" class="form-control" id="dni_cliente" name="dni_cliente" value="{if isset($vehiculo)}{$vehiculo.dni_cliente}{/if}" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Modificar Vehículo</button>
                    </form>

                    <!-- Mostrar mensaje de éxito o error -->
                    <div id="mensaje" class="message mt-3"></div>

                    <!-- Volver al Menú -->
                    <div class="text-center mt-3">
                        <a href="/menu" class="btn btn-secondary btn-sm">Volver al Menú</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-white text-center py-3 mt-auto" style="background-color: #004085;">
        <p>© 2024 Todos Los Derechos Reservados - AUTOMOTION</p>
    </footer>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script para manejar el formulario -->
    <script>
        // Función para manejar el envío del formulario sin recargar la página
        document.getElementById('formModificarVehiculo').onsubmit = function(event) {
            event.preventDefault(); // Evita que el formulario se envíe de manera tradicional

            const form = document.getElementById('formModificarVehiculo');
            const formData = new FormData(form); // Captura los datos del formulario

            fetch('/index.php?action=modificarVehiculo', {  // Envío de datos por método POST
                method: 'POST',
                body: formData  // Cuerpo del formulario
            })
            .then(response => response.text())  // Convertir la respuesta en texto
            .then(data => {
                // Mostrar el mensaje en el div con id 'mensaje'
                const mensajeDiv = document.getElementById('mensaje');
                mensajeDiv.innerHTML = data;  // Coloca el mensaje recibido en el div
                mensajeDiv.className = "alert alert-info";  // Asigna una clase para estilos (puedes personalizarlo)

                // Si la respuesta no contiene "Error", reiniciamos el formulario
                if (!data.includes("Error")) {
                    form.reset();  // Reinicia el formulario
                }
            })
            .catch(error => {
                // En caso de error en la solicitud, mostrar un mensaje de error
                const mensajeDiv = document.getElementById('mensaje');
                mensajeDiv.innerHTML = '<div class="alert alert-danger">Error al modificar el vehículo.</div>';
            });
        };
    </script>

</body>
</html>
