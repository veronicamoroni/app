<?php
/* Smarty version 5.4.0, created on 2025-02-18 13:08:50
  from 'file:eliminarServiciosRealizados.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.0',
  'unifunc' => 'content_67b478524ace54_94290942',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '76a45cb402f743b2ce0c52441281fb7535d0471b' => 
    array (
      0 => 'eliminarServiciosRealizados.tpl',
      1 => 1739880392,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:navbar.tpl' => 1,
  ),
))) {
function content_67b478524ace54_94290942 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\a - copia\\templates';
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Servicio Realizado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
    <link rel="stylesheet" href="/templates/styles/Formulario.css">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <?php $_smarty_tpl->assign('titulo', "Gestión de Servicios Realizados", false, NULL);?>
    <?php $_smarty_tpl->renderSubTemplate("file:navbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
  
    <!-- Contenedor principal -->
    <div class="container flex-fill mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow p-4">
                    <div class="card-header text-center">
                        <span class="material-symbols-outlined" style="font-size: 50px; color: #dc3545;">delete</span>
                        <h3 class="mt-2">Eliminar Servicio Realizado</h3>
                    </div>
                    <div class="card-body">
                        <form id="formEliminarServicio">
                            <div class="form-group">
                                <label for="id">ID del Servicio Realizado a Eliminar:</label>
                                <input type="text" class="form-control" id="id" name="id" required>
                            </div>
                            <button type="submit" class="btn btn-danger btn-lg btn-block">Eliminar Servicio</button>
                        </form>

                        <!-- Mensaje -->
                        <div id="mensaje" class="message mt-3 alert alert-info text-center" style="display: none;"></div>
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
        <p>© 2025 Automotion - Todos los derechos reservados</p>
    </footer>

    <!-- Script para manejar el envío del formulario -->
    <?php echo '<script'; ?>
>
        document.getElementById('formEliminarServicio').onsubmit = function(event) {
            event.preventDefault(); // Evita el envío automático del formulario

            if (!confirm("¿Estás seguro de que deseas eliminar este servicio realizado?")) {
                return;
            }

            const form = document.getElementById('formEliminarServicio');
            const formData = new FormData(form);

            fetch('/index.php?action=eliminarServicioRealizado', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                const mensajeDiv = document.getElementById('mensaje');
                mensajeDiv.innerHTML = data;
                mensajeDiv.style.display = "block"; // Muestra el mensaje
                mensajeDiv.className = "alert alert-info"; // Aplica estilos al mensaje

                // Si el mensaje no contiene "Error", reiniciar el formulario
                if (!data.includes("Error")) {
                    form.reset();
                }
            })
            .catch(() => {
                // En caso de error, mostrar el mensaje de error
                const mensajeDiv = document.getElementById('mensaje');
                mensajeDiv.innerHTML = '<div class="alert alert-danger">Error al eliminar el servicio realizado.</div>';
                mensajeDiv.style.display = "block";
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
