<?php

switch ($request) {
   
    case '/menu':
        $smarty->display('templates/menu.tpl');
        break;
    case '/menu/crearCliente':
        $smarty->display('templates/crearCliente.tpl');
        break;
    case '/menu/modificarCliente':
        $smarty->display('templates/modificarCliente.tpl');
        break;
    case '/menu/eliminarCliente':
        $smarty->display('templates/eliminarCliente.tpl');
        break;            
    case '/menu/listarClientes':
        $clientes = $clienteController->obtenerClientes();
        $smarty->assign('clientes', $clientes);
        $smarty->display('listarClientes.tpl');
        break;
    case '/menu/crearVehiculo':
        $smarty->display('templates/crearVehiculo.tpl');
        break;
    case '/menu/modificarVehiculo':
        $smarty->display('templates/modificarVehiculo.tpl');
        break;
    case '/menu/eliminarVehiculo':
        $smarty->display('templates/eliminarVehiculo.tpl');
        break;
    case '/menu/listarVehiculos':
            $vehiculos = $vehiculoController->obtenerVehiculos();
            $smarty->assign('vehiculos', $vehiculos);
            $smarty->display('listarVehiculos.tpl');
            break;    
    case '/menu/crearTurno':
        $smarty->display('templates/crearTurno.tpl');
        break;
    case '/menu/modificarTurno':
        $smarty->display('templates/modificarTurno.tpl');
        break;
    case '/menu/eliminarTurno':
        $smarty->display('templates/eliminarTurno.tpl');
        break;
    case '/menu/listarTurnos':
        $turnos = $turnoController->obtenerTurnos();  
        $smarty->assign('turnos', $turnos);  // Asignamos los turnos a Smarty
        $smarty->display('listarTurnos.tpl');  // Mostramos la plantilla para listar los turnos
        break;

    case '/menu/crearServicio':
        $smarty->display('templates/crearServicio.tpl'); 
        break;
    case '/menu/modificarServicio':
        $smarty->display('templates/modificarServicio.tpl'); 
        break;
    case '/menu/eliminarServicio':
        $smarty->display('eliminarServicio.tpl'); 
        break;
    case '/menu/listarServicios':
        $servicioController->listarServicios(); 
        break;
    case '/menu/crearServicioRealizado':
        $smarty->display('crearServicioRealizado.tpl'); 
        break;   
    case '/menu/modificarServicioRealizado':
        $smarty->display('modificarServicioRealizado.tpl'); 
        break;
    case '/menu/eliminarServicioRealizado':
        $smarty->display('eliminarServiciosRealizados.tpl'); 
        break;
    case '/menu/listarServicioRealizado':
        $servicios = $serviciorealizadoController->obtenerServiciosRealizados();
        $smarty->assign('servicios_realizados', $servicios);
        $smarty->display('listarServiciosRealizados.tpl'); 
        break; 
    }       