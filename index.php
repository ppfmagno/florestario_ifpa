<?php
// echo phpinfo();
require_once './models/dbcontrole.php';
$config = parse_ini_file('./config.ini');
$con = new DBcontrole($config);
$usuarios = $con->getUsuarios();
print_r($usuarios);
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