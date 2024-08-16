<?php

namespace Model;

class Cliente extends ActiveRecord {
    protected static $tabla = 'clientes';
    protected static $columnasDB = ['id', 'nombre', 'url', 'usuarios_id'];

    public $id;
    public $nombre;
    public $url;
    public $usuarios_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->nombre = $args['nombre'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->usuarios_id = $args['usuarios_id'] ?? '';
    }

    public function validarCliente() {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'Campo obligatorio: Nombre';
        }

        return self::$alertas;
    }
}