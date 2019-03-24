<?php

class Usuario {
  public $id;
  public $nome;
  public $login;
  public $email;
  public $crea;
  public $endereco;
  public $inventarios;

  function __construct($id, $nome, $login, $email, $crea, $endereco, $inventarios) {
    $this->id = $id;
    $this->nome = $nome;
    $this->login = $login;
    $this->email = $email;
    $this->crea = $crea;
    $this->endereco = $endereco;
    $this->inventarios = $inventarios;
  }

  public static function newEmpty() {
    $instance = new self(null, null, null, null, null, null, null);
    return $instance;
  }
}

?>