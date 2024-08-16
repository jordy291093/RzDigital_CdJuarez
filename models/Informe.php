<?php 

namespace Model;

class Informe extends ActiveRecord {
    protected static $tabla = 'informes';
    protected static $columnasDB = ['id', 'folio', 'fechaGen', 'modelo', 'serie', 'noParte', 'refacciones', 'falla', 'comentarios', 'contador', 'fechaEnt', 'status', 'clientes_id'];

    public $id;
    public $folio;
    public $fechaGen;
    public $modelo;
    public $serie;
    public $noParte;
    public $refacciones;
    public $falla;
    public $comentarios;
    public $contador;
    public $fechaEnt;
    public $status;
    public $clientes_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->folio = $args['folio'] ?? '';
        $this->fechaGen = $args['fechaGen'] ?? '';
        $this->modelo = $args['modelo'] ?? '';
        $this->serie = $args['serie'] ?? '';
        $this->noParte = $args['noParte'] ?? '';
        $this->refacciones = $args['refacciones'] ?? '';
        $this->falla = $args['falla'] ?? '';
        $this->comentarios = $args['comentarios'] ?? '';
        $this->contador = $args['contador'] ?? '';
        $this->fechaEnt = $args['fechaEnt'] ?? '';
        $this->status = $args['status'] ?? 0;
        $this->clientes_id = $args['clientes_id'] ?? '';
    }
}