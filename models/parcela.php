<?php

class Parcela {
  public $id;
  public $nome;
  public $largura;
  public $comprimento;
  public $data_modificacao;
  public $data_criacao;
  public $inventario;
  public $individuos;
  
  function __construct($id, $nome, $largura, $comprimento, $data_modificacao, $data_criacao, $inventario, $individuos) {
    $this->id = $id;
    $this->nome = $nome;
    $this->largura = $largura;
    $this->comprimento = $comprimento;
    $this->data_modificacao = $data_modificacao;
    $this->data_criacao = $data_criacao;
    $this->inventario = $inventario;
    $this->individuos = $individuos;
  }

  public static function newEmpty() {
    $instance = new self(null, null, null, null, null, null, null, null);
    return $instance;
  }
}

?>