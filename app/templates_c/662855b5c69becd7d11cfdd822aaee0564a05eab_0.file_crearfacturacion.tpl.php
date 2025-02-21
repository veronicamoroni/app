<?php
/* Smarty version 5.4.0, created on 2025-02-20 13:53:04
  from 'file:crearfacturacion.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.0',
  'unifunc' => 'content_67b725b0ed2c05_74055914',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '662855b5c69becd7d11cfdd822aaee0564a05eab' => 
    array (
      0 => 'crearfacturacion.tpl',
      1 => 1740055979,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67b725b0ed2c05_74055914 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\app1\\templates';
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Facturación</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Gestión de Facturación</h1>

        <!-- Formulario para crear una nueva factura -->
        <div class="card mb-5">
            <div class="card-header">
                <h3>Crear Factura</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="/index.php?action=crearFacturacion">
                     <div class="mb-3">
                        <label for="numero_factura" class="form-label">Número de Factura:</label>
                        <input type="text" id="numero_factura" name="numero_factura" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_factura" class="form-label">Fecha de Factura:</label>
                        <input type="date" id="fecha_factura" name="fecha_factura" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="metodo_pago" class="form-label">Método de Pago:</label>
                        <input type="text" id="metodo_pago" name="metodo_pago" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="servicio_realizado_id" class="form-label">ID del Servicio Realizado:</label>
                        <input type="number" id="servicio_realizado_id" name="servicio_realizado_id" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="monto_total" class="form-label">Monto Total:</label>
                        <input type="text" id="monto_total" name="monto_total" class="form-control" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Factura</button>
                </form>
            </div>
        </div>

        <!-- Tabla para mostrar las facturas -->
        <h3>Facturas Registradas</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Número de Factura</th>
                    <th>Fecha de Factura</th>
                    <th>Monto Total</th>
                    <th>Método de Pago</th>
                    <th>ID del Servicio Realizado</th>
                </tr>
            </thead>
            <tbody id="facturas-lista">
                <!-- Aquí se cargarán las facturas dinámicamente -->
            </tbody>
        </table>
    </div>

    <?php echo '<script'; ?>
 type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener el monto total al cambiar el servicio
        document.getElementById("servicio_realizado_id").addEventListener("change", function() {
            const servicioId = this.value;
            if(servicioId) {
                // Concatenar el ID al URL de la consulta
                fetch("costo.php?id=" + servicioId)
                    .then(response => response.json())
                    .then(data => {
                        const montoTotal = data ? data.monto_total : 0;
                        document.getElementById("monto_total").value = montoTotal;
                    })
                    .catch(error => console.error("Error al obtener el monto del servicio:", error));
            } else {
                document.getElementById("monto_total").value = "";
            }
        });

        // Cargar las facturas registradas en la tabla
        fetch("ruta_a_obtener_facturas.php")
            .then(response => response.json())
            .then(data => {
                const tabla = document.getElementById("facturas-lista");
                data.forEach(function(factura) {
                    const fila = "<tr>" +
                        "<td>" + factura.id + "</td>" +
                        "<td>" + factura.numero_factura + "</td>" +
                        "<td>" + factura.fecha_factura + "</td>" +
                        "<td>" + factura.monto_total + "</td>" +
                        "<td>" + factura.metodo_pago + "</td>" +
                        "<td>" + factura.servicio_realizado_id + "</td>" +
                    "</tr>";
                    tabla.innerHTML += fila;
                });
            })
            .catch(function(error) {
                console.error("Error al cargar las facturas:", error);
            });
    });
    <?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
