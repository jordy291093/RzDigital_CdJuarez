<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\LoginController;
use Controllers\DashboardController;
use Controllers\InformeController;
use Controllers\ServicioController;

$router = new Router();

// Login
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Crear cuenta
$router->get('/crear', [LoginController::class, 'crear']);
$router->post('/crear', [LoginController::class, 'crear']);

// Formulario de recuperar password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [LoginController::class, 'reestablecer']);
$router->post('/reestablecer', [LoginController::class, 'reestablecer']);

// Confirmacion de cuenta
$router->get('/mensaje', [LoginController::class, 'mensaje']);
$router->get('/confirmar', [LoginController::class, 'confirmar']);

//          ****   Dashboard   ****

$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/dashboard/vehiculo', [DashboardController::class, 'index_vehiculo']);

$router->get('/crear-cliente', [DashboardController::class, 'crear_cliente']);
$router->post('/crear-cliente', [DashboardController::class, 'crear_cliente']);
$router->get('/cliente', [DashboardController::class, 'cliente']);

$router->get('/crear-vehiculo', [DashboardController::class, 'crear_vehiculo']);
$router->post('/crear-vehiculo', [DashboardController::class, 'crear_vehiculo']);
$router->get('/vehiculo', [DashboardController::class, 'vehiculo']);

//          ****   API   ****
$router->get('/api/informes', [InformeController::class, 'index']);
$router->post('/api/informe', [InformeController::class, 'crear']);
$router->post('/api/informe/actualizar', [InformeController::class, 'actualizar']);

$router->get('/api/servicios', [ServicioController::class, 'index']);
$router->post('/api/servicio', [ServicioController::class, 'crear']);
$router->post('/api/servicio/actualizar', [ServicioController::class, 'actualizar']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();