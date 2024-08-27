<?php 

namespace Model;

class Vehiculo extends ActiveRecord {
    protected static $tabla = 'vehiculo';
    protected static $columnasDB = ['id', 'nombre', 'marca', 'modelo', 'año', 'placa', 'url', 'usuarios_id'];

    public $id;
    public $marca;
    public $modelo;
    public $nombre;
    public $año;
    public $placa;
    public $url;
    public $usuarios_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->nombre = $args['nombre'] ?? '';
        $this->marca = $args['marca'] ?? '';
        $this->modelo = $args['modelo'] ?? '';
        $this->año = $args['año'] ?? '';
        $this->placa = $args['placa'] ?? '';
        $this->url = $args['url'] ?? '';
        $this->usuarios_id = $args['usuarios_id'] ?? '';
    }

    public function validarVehiculo() {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'Campo obligatorio: Nombre';
        }
        if (!$this->marca) {
            self::$alertas['error'][] = 'Campo obligatorio: Marca';
        }
        if (!$this->modelo) {
            self::$alertas['error'][] = 'Campo obligatorio: Modelo';
        }
        if (!$this->año) {
            self::$alertas['error'][] = 'Campo obligatorio: Año';
        }
        if (!$this->placa) {
            self::$alertas['error'][] = 'Campo obligatorio: Placa';
        }

        return self::$alertas;
    }
}