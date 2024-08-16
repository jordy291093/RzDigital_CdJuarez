<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\ContadorController;
use MVC\Router;
use Controllers\LoginController;
use Controllers\DashboardController;
use Controllers\InformeController;

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

// Dashboard Reporte
$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/crear-cliente', [DashboardController::class, 'crear_cliente']);
$router->post('/crear-cliente', [DashboardController::class, 'crear_cliente']);
$router->get('/cliente', [DashboardController::class, 'cliente']);

// API Informes
$router->get('/api/informes', [InformeController::class, 'index']);
$router->post('/api/informe', [InformeController::class, 'crear']);
$router->post('/api/informe/actualizar', [InformeController::class, 'actualizar']);
$router->post('/api/informe/eliminar', [InformeController::class, 'eliminar']);

// Dashboard Contador
$router->get('/dashboard/contador', [ContadorController::class, 'index']);
$router->get('/crear-contador', [ContadorController::class, 'crear_contador']);
$router->post('/crear-contador', [ContadorController::class, 'crear_contador']);
$router->get('/contador', [ContadorController::class, 'contador']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();