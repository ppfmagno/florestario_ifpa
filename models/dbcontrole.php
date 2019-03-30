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
    $sql = 'INSERT INTO usuario (nome, login, email, senha, crea, endereco_id_endereco)
      VALUES ("'
      . $usuario->nome . '","'
      . $usuario->login . '","'
      . $usuario->email . '","'
      . $usuario->senha . '","'
      . $usuario->crea . '","'
      . $usuario->endereco . '")';
    $this->query($sql);
    echo $this->error;
  }

  public function updateUsuario($usuario) {
    $sql = 'UPDATE usuario
      SET nome = "' . $usuario->nome . '",
        login = "' . $usuario->login . '",
        email = "' . $usuario->email . '",
        senha = "' . $usuario->senha . '",
        crea = "' . $usuario->crea . '",
        endereco_id_endereco = "' . $usuario->endereco . '"
        WHERE usuario.id_usuario = ' . $usuario->id;
    $this->query($sql);
  }

  public function deleteUsuario($id) {
    $sql = 'DELETE FROM usuario WHERE id_usuario = ' . $id;
    $this->query($sql);
  }

  // INVENTARIOS
  public function getInventarios() {
    $sql = 'SELECT * FROM inventario';
    if (!$resultado = $this->query($sql)) {
      die('Erro na query[' . $this->error . ']');
    }
    while ($linha = $resultado->fetch_array()) {
      $inventarios[] = $linha;
    }
    return $inventarios;
  }

  public function insertInventario($inventario) {
    $sql = 'INSERT INTO inventario (nome_do_projeto, localidade_id_localidade, usuario_id_usuario)
      VALUES ("'
      . $inventario->nome . '","'
      . $inventario->localidade . '","'
      . $inventario->usuario . '")';
    $this->query($sql);
    echo $this->error;
  }

  public function deleteInventario($id) {
    $sql = 'DELETE FROM inventario WHERE id_inventario = ' . $id;
    $this->query($sql);
  }

  // LOCALIDADES
  public function getLocalidades() {
    $sql = 'SELECT * FROM localidade';
    if (!$resultado = $this->query($sql)) {
      die('Erro na query[' . $this->error . ']');
    }
    while ($linha = $resultado->fetch_array()) {
      $localidades[] = $linha;
    }
    return $localidades;
  }

  public function getLocalidadeById($id) {
    $sql = 'SELECT * FROM localidade WHERE localidade.id_localidade = ' . $id;
    if (!$resultado = $this->query($sql)) {
      die('Erro na query[' . $this->error . ']');      
    }
    return $resultado->fetch_array();
  }

  public function insertLocalidade($localidade) {
    $sql = 'INSERT INTO localidade (longitude, latitude, municipio_id_municipio)
      VALUES ("'
      . $localidade->longitude . '","'
      . $localidade->latitude . '","'
      . $localidade->municipio . '")';
    $this->query($sql);
    echo $this->error;
  }

  public function updateLocalidade($localidade) {
    $sql = 'UPDATE localidade
      SET longitude = "' . $localidade->longitude . '",
        latitude = "' . $localidade->latitude . '",
        municipio_id_municipio = "' . $localidade->municipio . '"
        WHERE localidade.id_localidade = ' . $localidade->id;
    $this->query($sql);
  }

  public function deleteLocalidade($id) {
    $sql = 'DELETE FROM localidade WHERE id_localidade = ' . $id;
    $this->query($sql);
  }

  // ENDEREÇOS
  public function getEnderecos() {
    $sql = 'SELECT * FROM endereco';
    if (!$resultado = $this->query($sql)) {
      die('Erro na query[' . $this->error . ']');
    }
    while ($linha = $resultado->fetch_array()) {
      $enderecos[] = $linha;
    }
    return $enderecos;
  }

  public function getEnderecoById($id) {
    $sql = 'SELECT * FROM endereco WHERE endereco.id_endereco = ' . $id;
    if (!$resultado = $this->query($sql)) {
      die('Erro na query[' . $this->error . ']');      
    }
    return $resultado->fetch_array();
  }

  public function insertEndereco($endereco) {
    $sql = 'INSERT INTO endereco (rua, cep, numero, bairro, municipio_id_municipio)
      VALUES ("'
      . $endereco->rua . '","'
      . $endereco->cep . '","'
      . $endereco->numero . '","'
      . $endereco->bairro . '","'
      . $endereco->municipio . '")';
    $this->query($sql);
  }

  public function updateEndereco($endereco) {
    $sql = 'UPDATE endereco
      SET rua = "' . $endereco->rua . '",
        cep = "' . $endereco->cep . '",
        numero = "' . $endereco->numero . '",
        bairro = "' . $endereco->bairro . '",
        municipio_id_municipio = "' . $endereco->municipio . '"
        WHERE endereco.id_endereco = ' . $endereco->id;
    $this->query($sql);
  }

  public function deleteEndereco($id) {
    $sql = 'DELETE FROM endereco WHERE id_endereco = ' . $id;
    $this->query($sql);
  }
    
  // MUNICÍPIOS
  public function getMunicipios() {
    $sql = 'SELECT * FROM municipio';
    if (!$resultado = $this->query($sql)) {
      die('Erro na query[' . $this->error . ']');
    }
    while ($linha = $resultado->fetch_array()) {
      $municipios[] = $linha;
    }
    return $municipios;
  }

  public function getMunicipioById($id) {
    $sql = 'SELECT * FROM municipio WHERE municipio.id_municipio = ' . $id;
    if (!$resultado = $this->query($sql)) {
      die('Erro na query[' . $this->error . ']');      
    }
    return $resultado->fetch_array();
  }

  public function insertMunicipio($municipio) {
    $sql = 'INSERT INTO municipio (nome, estado_id_estado)
      VALUES ("' . $municipio->nome . '","' . $municipio->estado . '")';
    $this->query($sql);
  }

  public function updateMunicipio($municipio) {
    $sql = 'UPDATE municipio
      SET nome = "' . $municipio->nome . '",
        estado_id_estado = "' . $municipio->estado . '"
        WHERE municipio.id_municipio = ' . $municipio->id;
    $this->query($sql);
  }

  public function deleteMunicipio($id) {
    $sql = 'DELETE FROM municipio WHERE id_municipio = ' . $id;
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
  
  //Pragas
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
  
  //Especies
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
  
  //Nome Popular das Especies
  public function getNomesPopulasByIdEspecie($id) {
    $sql = 'SELECT * FROM nome_popular_especie WHERE nome_popular_especie.especie_id_especie = ' . $id;
    if (!$resultado = $this->query($sql)) {
      die('Erro na query[' . $this->error . ']');      
    }
    while ($linha = $resultado->fetch_array()) {
      $nomes_populares[] = $linha;
    }
    return $nomes_populares;
  }
  
  public function inserirNomePopular($nomepopular){
      $sql = 'INSERT INTO nome_popular_especie (nome, especie_id_especie)
      VALUES ("'
      . $nomepopular->nome . '","'
      . $nomepopular->especie_id_especie . '")';
      $this->query($sql);
  }
  
  public function deletarNomePopular($id_nome_popular){
      $sql = 'DELETE FROM nome_popular_especie '
              . 'WHERE '
              . 'id_nome_popular_especie = '. $id_nome_popular;
      $this->query($sql);
  }
  
  //Individuos
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
            . 'individuo.circunferencia_altura_peito = "'. $individuo->circunferencia_altura_do_peito .'", '
            . 'individuo.oco = "'. $individuo->oco .'", '
            . 'individuo.especie_id_especie = "' . $individuo->especie . '" '
            .'WHERE individuo.id_individuo = ' . $individuo->id;
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
