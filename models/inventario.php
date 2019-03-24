<?php

class Inventario {
  public $id;
  public $nome;
  public $data_modificacao;
  public $data_criacao;
  public $localidade;
  public $parcelas;
  
  function __construct($id, $nome, $data_modificacao, $data_criacao, $localidade, $parcelas) {
    $this->id = $id;
    $this->nome = $nome;
    $this->data_modificacao = $data_modificacao;
    $this->data_criacao = $data_criacao;
    $this->localidade = $localidade;
    $this->parcelas = $parcelas;
  }

  public static function newEmpty() {
    $instance = new self(null, null, null, null, null, null);
    return $instance;
  }
}

?>