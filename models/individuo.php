<?php

class Individuo {
  public $id;
  public $circunferencia_copa;
  public $circunferencia_altura_do_peito;
  public $oco;
  public $data_modificacao;
  public $data_criacao;
  public $especie;
  public $pragas;
  
  function __construct($id, $circunferencia_copa, $circunferencia_altura_do_peito, $oco, $data_modificacao, $data_criacao, $especie, $pragas) {
    $this->id = $id;
    $this->circunferencia_copa = $circunferencia_copa;
    $this->circunferencia_altura_do_peito = $circunferencia_altura_do_peito;
    $this->oco = $oco;
    $this->data_modificacao = $data_modificacao;
    $this->data_criacao = $data_criacao;
    $this->especie = $especie;
    $this->pragas = $pragas;
  }

  public static function newEmpty() {
    $instance = new self(null, null, null, null, null, null, null, null);
    return $instance;
  }
}

?>