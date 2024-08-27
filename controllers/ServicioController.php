<?php 

namespace Controllers;

use Model\Servicio;
use Model\Vehiculo;

class ServicioController {
    public static function index() {
        session_start();
        isAuth();

        $vehiculo_id = $_GET['id'];
        if(!$vehiculo_id) header('Location: /dashboard/vehiculo');

        $vehiculo = Vehiculo::where('url', $vehiculo_id);

        if(!$vehiculo || $vehiculo->usuarios_id !== $_SESSION['id']) {
            header('Location: /404');
        }

        $servicio = Servicio::belongsTo('vehiculo_id', $vehiculo->id);

        echo json_encode(['servicio' => $servicio]);
    }

    public static function crear() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            // encontrar la url del vehiculo
            $vehiculo_id = $_POST['vehiculo_id'];
            $vehiculo = Vehiculo::where('url', $vehiculo_id);
            if(!$vehiculo || $vehiculo->usuarios_id !== $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error en agregar el servicio'
                ];

                echo json_encode($respuesta);
                return;
            }

            $servicio = new Servicio($_POST);

            $servicio->vehiculo_id = $vehiculo->id;
            $resultado = $servicio->guardar();
            $respuesta = [
                'tipo' => 'exito',
                'id' => $resultado['id'],
                'mensaje' => 'Servicio creado exitosamente',
                'vehiculo_id' => $vehiculo->id
            ];
            echo json_encode($respuesta);
            // echo json_encode($servicio);
        }
    }

    public static function actualizar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            $id = $_POST['vehiculo_id'];
            $vehiculo = Vehiculo::where('url', $id);

            if(!$vehiculo || $vehiculo->usuarios_id !== $_SESSION['id']) {
                $respuesta = [
                    'tipo' => 'error',
                    'mensaje' => 'Hubo un error al actualizar el servicio'
                ];
                echo json_encode($respuesta);
                return;
            }

            $servicio = new Servicio($_POST);
            $servicio->vehiculo_id = $vehiculo->id;

            $resultado = $servicio->guardar();
            if($resultado) {
                $respuesta = [
                    'tipo' => 'exito',
                    'id' => $servicio->id,
                    'vehiculo_id' => $vehiculo->id,
                    'mensaje' => 'Actualizado Correctamente'
                ];
                echo json_encode(['respuesta' => $respuesta]);
                // echo json_encode(['resultado' => $resultado]);
            }
        }
    }
}