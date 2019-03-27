<?php
require_once './models/estado.php';
require_once './models/municipio.php';
require_once './models/endereco.php';
require_once './models/usuario.php';
$us = Usuario::newEmpty();
$us->nome = 'John Doe';
$us->login = 'johndoe78987';
$us->email = 'jhondoe123@j.doe';
$us->senha = '1345';
$us->crea = '78864564';
$us->endereco = Endereco::newEmpty();
$us->endereco->rua = 'Rua Longe';
$us->endereco->cep = '13245678';
$us->endereco->numero = 456;
$us->endereco->municipio = Municipio::newEmpty();
$us->endereco->municipio->nome = 'Belém';
$us->endereco->municipio->estado = Estado::newEmpty();
$us->endereco->municipio->estado->nome = 'Pará';

require_once './models/dbcontrole.php';
$dbconfig = parse_ini_file('./dbconfig.ini');
$con = new DBcontrole($dbconfig);

// $estado = Estado::newEmpty();
// $estado->nome = 'Acre';

$con->insertUsuario($us);

?>
<?php include_once './views/partials/header.php'; ?>

  <ul>
    <li><a href="./views/usuarios.php">Usuários</a></li>
    <li><a href="./views/inventatios.php">Inventários</a></li>
    <li><a href="./views/parcelas.php">Parcelas</a></li>
    <li><a href="./views/individuos.php">Indivíduos</a></li>
    <li><a href="./views/pragas.php">Pragas</a></li>
  </ul>
<?php include_once './views/partials/footer.php'; ?>