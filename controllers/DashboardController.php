<?php 

namespace Controllers;

use MVC\Router;
use Model\Cliente;

class DashboardController {
    public static function index(Router $router) {
        session_start();
        isAuth();

        $id = $_SESSION['id'];
        $clientes = Cliente::belongsTo('usuarios_id', $id);

        $router->render('dashboard/reporte/index', [
            'titulo' => "Reportes",
            'clientes' => $clientes
        ]);
    }

    public static function crear_cliente(Router $router) {
        session_start();
        isAuth();

        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente = new Cliente($_POST);
            $alertas = $cliente->validarCliente();

            if (empty($alertas)) {
                // Generar una URL unica
                $hash = md5(uniqid());
                $cliente->url = $hash;

                // Almacenar el creador del cliente
                $cliente->usuarios_id = $_SESSION['id'];

                // Guardar cliente
                $cliente->guardar();

                header('Location: /cliente?id=' . $cliente->url);
            }
        }

        $router->render('dashboard/reporte/crear-cliente', [
            'titulo' => "Crear Reporte",
            'alertas' => $alertas
        ]);
    }

    public static function cliente(Router $router) {
        session_start();
        isAuth();

        $token = $_GET['id'];
        if (!$token) header('Location: /dashboard');
        // Revisar que la persona visita el proyecto, quien lo creo
        $cliente = Cliente::where('url', $token);
        if ($cliente->usuarios_id !== $_SESSION['id']) {
            header('Location: /dashboard');
        }

        $router->render('dashboard/reporte/informe', [
            'titulo' => $cliente->nombre
        ]);
    }

    // public static function perfil(Router $router) {
    //     session_start();
    //     isAuth();

    //     $router->render('dashboard/perfil', [
    //         'titulo' => "Perfil"
    //     ]);
    // }
}