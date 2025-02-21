<?php
/* Smarty version 5.4.0, created on 2025-02-20 23:51:03
  from 'file:templates/modificarVehiculo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.0',
  'unifunc' => 'content_67b7b1d7792ff4_20092497',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c6eea87f6d1b452a9425596913d0ed5a6446dd3a' => 
    array (
      0 => 'templates/modificarVehiculo.tpl',
      1 => 1740089199,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:navbar.tpl' => 1,
  ),
))) {
function content_67b7b1d7792ff4_20092497 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\EDI\\app\\templates';
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Vehículo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=swap">
  
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

    <?php $_smarty_tpl->assign('titulo', "Gestión de Vehículos", false, NULL);?>
    <?php $_smarty_tpl->renderSubTemplate("file:navbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

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
                            <input type="text" class="form-control" id="patente" name="patente" value="<?php if ((null !== ($_smarty_tpl->getValue('vehiculo') ?? null))) {
echo $_smarty_tpl->getValue('vehiculo')['patente'];
}?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nueva_patente">Nueva Patente:</label>
                            <input type="text" class="form-control" id="nueva_patente" name="nueva_patente" placeholder="Opcional">
                        </div>
                        <div class="form-group">
                            <label for="marca">Marca:</label>
                            <input type="text" class="form-control" id="marca" name="marca" value="<?php if ((null !== ($_smarty_tpl->getValue('vehiculo') ?? null))) {
echo $_smarty_tpl->getValue('vehiculo')['marca'];
}?>" required>
                        </div>
                        <div class="form-group">
                            <label for="modelo">Modelo:</label>
                            <input type="text" class="form-control" id="modelo" name="modelo" value="<?php if ((null !== ($_smarty_tpl->getValue('vehiculo') ?? null))) {
echo $_smarty_tpl->getValue('vehiculo')['modelo'];
}?>" required>
                        </div>
                        <div class="form-group">
                            <label for="dni_cliente">DNI del Cliente:</label>
                            <input type="text" class="form-control" id="dni_cliente" name="dni_cliente" value="<?php if ((null !== ($_smarty_tpl->getValue('vehiculo') ?? null))) {
echo $_smarty_tpl->getValue('vehiculo')['dni_cliente'];
}?>" required>
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
    <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.5.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"><?php echo '</script'; ?>
>

    <!-- Script para manejar el formulario -->
    <?php echo '<script'; ?>
>
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
    <?php echo '</script'; ?>
>

</body>
</html>
<?php }
}
