<?php 

namespace Model;

class Servicio extends ActiveRecord {
    protected static $tabla = 'servicio';
    protected static $columnasDB = ['id', 'servicio', 'comentarios', 'fecha', 'vehiculo_id'];

    public $id;
    public $servicio;
    public $comentarios;
    public $fecha;
    public $vehiculo_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->servicio = $args['servicio'] ?? '';
        $this->comentarios = $args['comentarios'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->vehiculo_id = $args['vehiculo_id'] ?? '';
    }
}