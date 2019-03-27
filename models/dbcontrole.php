<?php

class DBcontrole extends mysqli {
  function __construct($config) {
    parent::__construct($config[server], $config[usuario], $config[senha], $config[dbname]);
  }

  public function getUsuarios() {
    $sql = 'SELECT * FROM usuario';
    if (!$resultado = $this->query($sql)) {
      die('Erro na query[' . $this->error . ']');
    }
    while ($linha = $resultado->fetch_array()) {
      $usuarios[] = $linha;
    }
    return $usuarios;
  }
}