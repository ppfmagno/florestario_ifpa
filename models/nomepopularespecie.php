<?php

class NomePopularEspecie{
    public $id;
    public $nome;
    public $especie_id_especie;
    
    function __construct($id, $nome, $especie_id_especie) {
        $this->id = $id;
        $this->nome = $nome;
        $this->especie_id_especie = $especie_id_especie;
    }

    public static function newEmpty() {
        $instance = new self(null, null, null);
        return $instance;
    }
    
}
