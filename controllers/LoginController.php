<?php 

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Classes\Email;

class LoginController {
    public static function login(Router $router) {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);

            $alertas = $usuario->validarLogin();

            if (empty($alertas)) {
                $usuario = Usuario::where('email' , $usuario->email);

                if(!$usuario || !$usuario->confirmado) {
                    Usuario::setAlerta('error', 'El usuario no existe ó no esta confirmado');
                } else {
                    // El usuario existe
                    if (password_verify($_POST['password'], $usuario->password)) {
                        // Iniciar sesión
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        header('Location: /dashboard');
                    } else {
                        Usuario::setAlerta('error', 'La contraseña es incorrecta');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'titulo' => "Iniciar Sesión", // Titulo de la pagina
            'alertas' => $alertas
        ]);
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    public static function crear(Router $router) {
        $usuario = new Usuario;
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if (empty($alertas)) {
                $existeUser = Usuario::where('email', $usuario->email);

                if ($existeUser) {
                    Usuario::setAlerta('error', 'El usuario ya existe');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear password
                    $usuario->hashPass();

                    // Eliminar el password2
                    unset($usuario->password2);

                    // Generar token
                    $usuario->crearToken();

                    // debuguear($usuario);

                    // Enviar Email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();
                    
                    $resultado = $usuario->guardar();

                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $router->render('auth/crear', [
            'titulo' => "Crear cuenta",
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function olvide(Router $router) {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if (empty($alertas)) {
                // Buscar el usuario
                $usuario = Usuario::where('email', $usuario->email);

                if ($usuario && $usuario->confirmado) {
                    // Generar un nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);

                    //Actualizar el usuario
                    $usuario->guardar();

                    // Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    //Imprimir la alerta
                    Usuario::setAlerta('exito', 'Revisa tu email para actualizar tu contraseña.');

                } else {
                    Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado');
                }
            }
        }
        
        $alertas = Usuario::getAlertas();

        $router->render('auth/olvide', [
            'titulo' => "Recuperar Password",
            'alertas' => $alertas
        ]);
    }

    public static function reestablecer(Router $router) {
        $token = s($_GET['token']);
        $mostrar = true;

        if (!$token) header('Location: /');

        // Identificar el usuario con este token
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Token no válido');
            $mostrar = false;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Añadir la nueva contraseña
            $usuario->sincronizar($_POST);

            // Validar la contraseña
            $alertas = $usuario->validarPassword();

            if (empty($alertas)) {
                $usuario->hashPass();
                $usuario->token = null;
                $resultado = $usuario->guardar();

                if ($resultado) {
                    header('Location /');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/reestablecer', [
            'titulo' => "Actualizar contraseña",
            'alertas' => $alertas,
            'mostrar' => $mostrar
        ]);
    }

    public static function mensaje(Router $router) {

        $router->render('auth/mensaje', [
            'titulo' => "Instrucciones"
        ]);

    }

    public static function confirmar(Router $router) {
        $token = s($_GET['token']);
        if (!$token) header('Location: /');

        // Encontrar al usuario con este token
        $usuario = Usuario::where('token', $token);
        if (empty($usuario)) {
            Usuario::setAlerta('error', 'Token no válido');
        } else {
            $usuario->confirmado = 1;
            $usuario->token = null;
            unset($usuario->password2);

            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta confirmada exitosamente');            
        }

        $alertas = Usuario::getAlertas();
        
        $router->render('auth/confirmar', [
            'titulo' => "Confirmar Email",
            'alertas' => $alertas
        ]);

    }
}