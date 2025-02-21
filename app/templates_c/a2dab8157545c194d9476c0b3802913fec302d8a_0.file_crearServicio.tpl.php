<?php
/* Smarty version 5.4.0, created on 2025-02-20 22:09:08
  from 'file:templates/crearServicio.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.0',
  'unifunc' => 'content_67b799f4168426_29579860',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a2dab8157545c194d9476c0b3802913fec302d8a' => 
    array (
      0 => 'templates/crearServicio.tpl',
      1 => 1740085728,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:navbar.tpl' => 1,
  ),
))) {
function content_67b799f4168426_29579860 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\app1 - copia\\templates';
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Servicio</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
   
</head>
<body class="d-flex flex-column min-vh-100">
    <?php $_smarty_tpl->assign('titulo', "Gestión de Servicios", false, NULL);?>
    <?php $_smarty_tpl->renderSubTemplate("file:navbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
   
    
    <!-- Contenedor principal -->
    <div class="container flex-fill mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <span class="material-symbols-outlined" style="font-size: 50px; color: #007bff;">build</span>
                        <h3 class="mt-2">Registrar Servicio</h3>
                    </div>
                    <div class="card-body">
                        <form id="formCrearServicio">
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="costo">Costo:</label>
                                <input type="number" class="form-control" id="costo" name="costo" step="0.01" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                <span class="material-symbols-outlined" style="font-size: 20px;">build</span> Registrar Servicio
                            </button>
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
    <footer class="text-white text-center py-3 mt-auto" style="background-color: #004085;">
        <p>© 2024 Todos Los Derechos Reservados - AUTOMOTION</p>
    </footer>

    <!-- Manejo del formulario con fetch -->
    <?php echo '<script'; ?>
>
        document.getElementById('formCrearServicio').onsubmit = function(event) {
            event.preventDefault(); // Evita el envío tradicional del formulario

            const form = document.getElementById('formCrearServicio');
            const formData = new FormData(form);

            fetch('/index.php?action=crearServicio', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                const mensajeDiv = document.getElementById('mensaje');
                mensajeDiv.innerHTML = data;
                mensajeDiv.style.display = "block";
                mensajeDiv.className = "alert alert-info";

                // Si la respuesta no indica error, limpia el formulario
                if (!data.includes("Error")) {
                    form.reset();
                } else {
                    mensajeDiv.className = "alert alert-danger";
                }
            })
            .catch(() => {
                // Manejo de error en la solicitud
                const mensajeDiv = document.getElementById('mensaje');
                mensajeDiv.innerHTML = 'Error al registrar el servicio. Inténtalo más tarde.';
                mensajeDiv.style.display = "block";
                mensajeDiv.className = "alert alert-danger";
            });
        };
    <?php echo '</script'; ?>
>

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
</body>
</html>


<?php }
}
