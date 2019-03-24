<?php

class Endereco {
  public $id;
  public $rua;
  public $cep;
  public $numero;
  public $bairro;
  public $municipio;

  function __construct($id, $rua, $cep, $numero, $bairro, $municipio) {
    $this->id = $id;
    $this->rua = $rua;
    $this->cep = $cep;
    $this->numero = $numero;
    $this->bairro = $bairro;
    $this->municipio = $municipio;
  }

  public static function newEmpty() {
    $instance = new self(null, null, null, null, null, null);
    return $instance;
  }
}

?>