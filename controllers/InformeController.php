<?php 

namespace Controllers;

use Model\Informe;
use Model\Cliente;

class InformeController {
    public static function index() {
        session_start();
        isAuth();

        $clientes_id = $_GET['id'];
        if(!$clientes_id) header('Location: /dashboard');

        $cliente = Cliente::where('url', $clientes_id);

        if(!$cliente || $cliente->usuarios_id !== $_SESSION['id']) {
            header('Location: /404');
        }

        $informe = Informe::belongsTo('clientes_id', $cliente->id);

        echo json_encode(['informe' => $informe]);

    }

    public static function crear() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            // encontrar la url del cliente
            $clientes_id = $_POST['clientes_id'];
            $cliente = Cliente::where('url', $clientes_id);
            if(!$cliente || $cliente->usuarios_id !== $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error en agregar el informe'
                ];

                echo json_encode($respuesta);
                return;
            }

            $informe = new Informe($_POST);
            // Guardar el id del informe
            $informe->clientes_id = $cliente->id;
            $resultado = $informe->guardar();
            $respuesta = [
                'tipo' => 'exito',
                'id' => $resultado['id'],
                'mensaje' => 'Informe creado exitosamente',
                'clientes_id' => $cliente->id
            ];
            echo json_encode($respuesta);
            // echo json_encode($informe);
        }
    }

    public static function actualizar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            
            $id = $_POST['clientes_id'];
            $cliente = Cliente::where('url', $id);

            if(!$cliente || $cliente->usuarios_id !== $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al actualizar el informe'
                ];
                echo json_encode($respuesta);
                return;
            }

            $informe = new Informe($_POST);
            $informe->clientes_id = $cliente->id;

            $resultado = $informe->guardar();
            if($resultado) {
                $respuesta = [
                    'tipo' => 'exito',
                    'id' => $informe->id,
                    'clientes_id' => $cliente->id,
                    'mensaje' => 'Actualizado Correctamente'
                ];
                echo json_encode(['respuesta' => $respuesta]);
            }
        }
    }
}