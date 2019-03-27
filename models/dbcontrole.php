<?php

class DBcontrole extends mysqli {
  function __construct($config) {
    parent::__construct($config['server'], $config['usuario'], $config['senha'], $config['dbname']);
  }

  // USUÁRIOS
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

  public function getUsuarioById($id) {
    $sql = 'SELECT * FROM usuario WHERE usuario.id_usuario = ' . $id;
    if (!$resultado = $this->query($sql)) {
      die('Erro na query[' . $this->error . ']');      
    }
    return $resultado->fetch_array();
  }

  public function insertUsuario($usuario) {
    $this->insertEndereco($usuario->endereco);
    $sql = 'INSERT INTO usuario (nome, login, email, senha, crea, endereco_id_endereco)
      VALUES ("'
      . $usuario->nome . '","'
      . $usuario->login . '","'
      . $usuario->email . '","'
      . $usuario->senha . '","'
      . $usuario->crea . '","'
      . $this->insert_id . '")';
    $this->query($sql);
    echo $this->error;
  }
    
    // ENDEREÇOS
  public function insertEndereco($endereco) {
    $this->insertCidade($endereco->municipio);
    $sql = 'INSERT INTO endereco (rua, cep, numero, bairro, municipio_id_municipio)
      VALUES ("'
      . $endereco->rua . '","'
      . $endereco->cep . '","'
      . $endereco->numero . '","'
      . $endereco->bairro . '","'
      . $this->insert_id . '")';
    $this->query($sql);
  }
    
  // CIDADES
  public function insertCidade($municipio) {
    $this->insertEstado($municipio->estado);
    $sql = 'INSERT INTO municipio (nome, estado_id_estado)
      VALUES ("' . $municipio->nome . '","' . $this->insert_id . '")';
    $this->query($sql);
  }
  
  // ESTADOS
  public function insertEstado($estado) {
    $sql = 'INSERT INTO estado (nome) VALUE ("' . $estado->nome . '")';
    $this->query($sql);
  }
}