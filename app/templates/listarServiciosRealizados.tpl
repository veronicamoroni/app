<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Servicios Realizados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
</head>
<body class="bg-light">
    {assign var="titulo" value="Gestión de Servicios Realizados"}
    {include file="navbar.tpl"}

    <div class="container mt-5">
        <h1 class="text-center mb-4 text-white p-3 rounded" style="background: linear-gradient(to right, #007bff, #00c6ff);">
            Lista de Servicios Realizados
        </h1>

        <!-- Tabla para listar servicios realizados con estilos mejorados -->
        <div class="table-responsive shadow-lg p-3 bg-white rounded">
            <table class="table table-bordered table-striped table-hover">
                <thead class="bg-secondary text-white text-center">
                    <tr>
                        <th>ID</th>
                        <th>Turno ID</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Servicio ID</th>
                        <th>Nombre</th>
                        <th>Costo</th>
                        <th>Notas</th>
                        <th>Patente</th>
                    </tr>
                </thead>
                <tbody>
                    {if $servicios_realizados|@count > 0}
                        {foreach from=$servicios_realizados item=servicio_realizado}
                            <tr class="text-center">
                                <td>{$servicio_realizado.servicio_realizado_id}</td>
                                <td>{$servicio_realizado.turno_id}</td>
                                <td>{$servicio_realizado.fecha_turno|date_format:"%d-%m-%Y"}</td>
                                <td>{$servicio_realizado.hora_turno}</td>
                                <td>{$servicio_realizado.servicio_id}</td>
                                <td>{$servicio_realizado.servicio_nombre}</td>
                                <td>{$servicio_realizado.costo}</td>
                                <td>{$servicio_realizado.notas}</td>
                                <td>{$servicio_realizado.patente_vehiculo}</td>
                            </tr>
                        {/foreach}
                    {else}
                        <tr>
                            <td colspan="9" class="text-center text-danger fw-bold">No hay servicios realizados registrados.</td>
                        </tr>
                    {/if}
                </tbody>
            </table>
        </div>

        <div class="text-center mt-3">
            <a href="/menu" class="btn btn-secondary btn">Volver al Menú</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
