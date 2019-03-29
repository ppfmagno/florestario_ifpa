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
    
  // MUNICÍPIOS
  public function insertMunicipio($municipio) {
    $sql = 'INSERT INTO municipio (nome, estado_id_estado)
      VALUES ("' . $municipio->nome . '","' . $municipio->estado . '")';
    $this->query($sql);
  }
  
  // ESTADOS
  public function getEstados() {
    $sql = 'SELECT * FROM estado';
    if (!$resultado = $this->query($sql)) {
      die('Erro na query[' . $this->error . ']');
    }
    while ($linha = $resultado->fetch_array()) {
      $estados[] = $linha;
    }
    return $estados;
  }

  public function getEstadoById($id) {
    $sql = 'SELECT * FROM estado WHERE estado.id_estado = ' . $id;
    if (!$resultado = $this->query($sql)) {
      die('Erro na query[' . $this->error . ']');      
    }
    return $resultado->fetch_array();
  }

  public function insertEstado($estado) {
    $sql = 'INSERT INTO estado (nome) VALUE ("' . $estado->nome . '")';
    $this->query($sql);
  }

  public function updateEstado($estado) {
    $sql = 'UPDATE estado
      SET nome = "' . $estado->nome . '"
      WHERE estado.id_estado = ' . $estado->id;
    $this->query($sql);
  }

  public function deleteEstado($id) {
    $sql = 'DELETE FROM estado WHERE id_estado = ' . $id;
    $this->query($sql);
  }
  
  public function getPragas(){
    $sql = 'SELECT * FROM praga';
    if (!$resultado = $this->query($sql)) {
      die('Erro na query[' . $this->error . ']');
    }
    while ($linha = $resultado->fetch_array()) {
      $pragas[] = $linha;
    }
    return $pragas;
  }
  
  public function insertPraga($praga){
    $sql = 'INSERT INTO praga (nome_cientifico) VALUE ("' . $praga->nome_cientifico . '")';
    $this->query($sql);
  }
  
  public function deletePraga($id) {
    $sql = 'DELETE FROM praga WHERE id_praga = ' . $id;
    $this->query($sql);
  }
  
  public function updatePraga($praga){
    $sql = 'UPDATE praga
    SET praga.nome_cientifico = "' . $praga->nome_cientifico . '"
    WHERE praga.id_praga = ' . $praga->id;
    $this->query($sql);
  }
  
  public function getPragaById($id) {
    $sql = 'SELECT * FROM praga WHERE praga.id_praga = ' . $id;
    if (!$resultado = $this->query($sql)) {
      die('Erro na query[' . $this->error . ']');      
    }
    return $resultado->fetch_array();
  }
  
  public function getEspecies(){
    $sql = 'SELECT * FROM especie';
    if (!$resultado = $this->query($sql)) {
      die('Erro na query[' . $this->error . ']');
    }
    while ($linha = $resultado->fetch_array()) {
      $especies[] = $linha;
    }
    return $especies;
  }
  
  public function insertEspecie($especie){
    $sql = 'INSERT INTO especie (nome_cientifico) VALUE ("' . $especie->nome_cientifico . '")';
    $this->query($sql);
  }
  
  public function deleteEspecie($id) {
    $sql = 'DELETE FROM especie WHERE id_especie = ' . $id;
    $this->query($sql);
  }
  
  public function updateEspecie($especie){
    $sql = 'UPDATE especie
    SET especie.nome_cientifico = "' . $especie->nome_cientifico . '"
    WHERE especie.id_especie = ' . $especie->id;
    $this->query($sql);
  }
  
  public function getEspecieById($id) {
    $sql = 'SELECT * FROM especie WHERE especie.id_especie = ' . $id;
    if (!$resultado = $this->query($sql)) {
      die('Erro na query[' . $this->error . ']');      
    }
    return $resultado->fetch_array();
  }
  
  public function getIndividuos(){
    $sql = 'SELECT * FROM individuo';
    if (!$resultado = $this->query($sql)) {
      die('Erro na query[' . $this->error . ']');
    }
    while ($linha = $resultado->fetch_array()) {
      $especies[] = $linha;
    }
    return $especies;
  }
  
  public function insertIndividuo($individuo){
    $sql = 'INSERT INTO individuo (circunferencia_copa, circunferencia_altura_peito, oco, '
                                . 'especie_id_especie, parcela_id_parcela) '
                                . 'VALUE ("' . $individuo->circunferencia_copa . '", '
                                . ' "' . $individuo->circunferencia_altura_do_peito . '", '
                                . ' "' . $individuo->oco . '", '
                                . ' "' . $individuo->especie . '", '
                                . ' "1")';
    $this->query($sql);
  }
  
  public function deleteIndividuo($id) {
    $sql = 'DELETE FROM individuo WHERE id_individuo = ' . $id;
    $this->query($sql);
  }
  
  public function updateIndividuo($individuo){
    $sql = 'UPDATE individuo
            SET individuo.circunferencia_copa = "' . $individuo->circunferencia_copa . '", '
            . 'individuo.circunferencia_altura_peito = "'+ $individuo->circunferencia_altura_do_peito +'", '
            . 'individuo.oco = "'+ $individuo->oco +'" '
            .'WHERE individuo.id_especie = ' . $individuo->id;
    $this->query($sql);
  }
  
  public function getIndividuoById($id) {
    $sql = 'SELECT * FROM individuo WHERE individuo.id_individuo = ' . $id;
    if (!$resultado = $this->query($sql)) {
      die('Erro na query[' . $this->error . ']');      
    }
    return $resultado->fetch_array();
  }
  
}