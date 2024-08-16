<?php 

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $password2;
    public $token;
    public $confirmado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    // Validar login de usuarios
    public function validarLogin() {
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El email no es válido';
        }

        if (!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatorio';
        }

        return self::$alertas;
    }

    // Validacion para cuentas nuevas
    public function validarNuevaCuenta() {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }

        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if (!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatorio';
        }

        if (strlen($this->password) <= 7) {
            self::$alertas['error'][] = 'La contraseña debe tener mínimo de 8 caracteres';
        }

        if ($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Las contraseñas no coinciden';
        }

        return self::$alertas;
    }

    public function validarPassword() {

        if (!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatorio';
        }

        if (strlen($this->password) <= 7) {
            self::$alertas['error'][] = 'La contraseña debe tener mínimo de 8 caracteres';
        }

        return self::$alertas;
    }

    public function validarEmail() {
        if (!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'El email no es válido';
        }

        return self::$alertas;
    }

    public function hashPass() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken() {
        $this->token = md5(uniqid());
    }
}