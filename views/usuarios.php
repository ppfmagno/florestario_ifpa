<?php
// essas três próximas linhas tem que ficar juntas
// e se um modelo ser usado pro método do banco (ex: $con->adicionarUsuario($usuario)),
// o arquivo da classe tem que vir antes do método
require_once '../models/dbcontrole.php';
$dbconfig = parse_ini_file('../dbconfig.ini');
$con = new DBcontrole($dbconfig);

$usuarios = $con->getUsuarios();
$usuario = $con->getUsuarioById(1);

print_r($usuario);

?>
<?php include_once './partials/header.php'; ?>



<?php include_once './partials/footer.php'; ?>