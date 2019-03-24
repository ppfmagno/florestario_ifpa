<?php

class Estado {
  public $id;
  public $nome;
  
  function __construct($id, $nome) {
    $this->id = $id;
    $this->nome = $nome;
  }

  public static function newEmpty() {
    $instance = new self(null, null);
    return $instance;
  }
}

?>