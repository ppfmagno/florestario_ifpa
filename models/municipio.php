<?php

class Municipio {
  public $id;
  public $nome;
  public $estado;

  function __construct($id, $nome, $estado) {
    $this->id = $id;
    $this->nome = $nome;
    $this->estado = $estado;
  }

  public static function newEmpty() {
    $instance = new self(null, null, null);
    return $instance;
  }
}

?>