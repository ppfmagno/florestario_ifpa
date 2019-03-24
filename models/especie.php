<?php

class Especie {
  public $id;
  public $nome_cientifico;
  public $nomes_populares;
  
  function __construct($id, $nome_cientifico, $nomes_populares) {
    $this->id = $id;
    $this->nome_cientifico = $nome_cientifico;
    $this->nomes_populares = $nomes_populares;
  }

  public static function newEmpty() {
    $instance = new self(null, null, null);
    return $instance;
  }
}

?>