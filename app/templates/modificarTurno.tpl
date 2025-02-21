<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Turno</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
</head>
<body class="d-flex flex-column min-vh-100">

    {assign var="titulo" value="Gestión de Turnos"}
    {include file="navbar.tpl"}

    <!-- Contenedor principal -->
    <div class="container flex-fill mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <span class="material-symbols-outlined" style="font-size: 50px; color: #007bff;">edit</span>
                        <h3 class="mt-2">Actualizar Turno</h3>
                    </div>
                    <div class="card-body">
                        <!-- Formulario de actualización de turno -->
                        <form id="formActualizarTurno">
                            <div class="form-group">
                                <label for="id">ID del Turno:</label>
                                <input type="text" class="form-control" id="id" name="id" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha">Fecha:</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" required>
                            </div>
                            <div class="form-group">
                                <label for="hora">Hora:</label>
                                <input type="time" class="form-control" id="hora" name="hora" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                            </div>
                            <div class="form-group">
                                <label for="patente">Patente del Vehículo:</label>
                                <input type="text" class="form-control" id="patente" name="patente" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Actualizar Turno</button>
                        </form>

                        <!-- Mensaje de éxito o error -->
                        <div id="mensaje" class="message mt-3" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Volver al Menú -->
        <div class="text-center mt-3">
            <a href="/menu" class="btn btn-secondary btn-sm">Volver al Menú</a>
        </div>
    </div>

    <!-- Footer -->
    <footer style="background-color: #004085;" class="text-white text-center py-3 mt-auto">
        <p>© 2024 Todos Los Derechos Reservados - AUTOMOTION</p>
    </footer>

    <!-- Manejo de actualización de turnos con fetch -->
    <script>
        document.getElementById('formActualizarTurno').onsubmit = function(event) {
            event.preventDefault(); // Evita el envío del formulario por defecto

            const form = document.getElementById('formActualizarTurno');
            const formData = new FormData(form);

            fetch('/index.php?action=modificarTurno', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                const mensajeDiv = document.getElementById('mensaje');
                mensajeDiv.innerHTML = data;
                mensajeDiv.style.display = "block"; // Muestra el mensaje
                mensajeDiv.className = "alert alert-info"; // Estilo por defecto

                // Si no se detecta un error, reinicia el formulario
                if (!data.includes("Error")) {
                    form.reset();
                } else {
                    mensajeDiv.className = "alert alert-danger"; // Cambia el estilo si es un error
                }
            })
            .catch(() => {
                // Manejo de errores en la solicitud
                const mensajeDiv = document.getElementById('mensaje');
                mensajeDiv.innerHTML = 'Error al actualizar el turno. Inténtalo de nuevo más tarde.';
                mensajeDiv.style.display = "block";
                mensajeDiv.className = "alert alert-danger";
            });
        };
    </script>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
