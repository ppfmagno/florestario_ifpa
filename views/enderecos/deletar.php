<?php
require_once '../../models/endereco.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);

if (isset($_GET['id'])) {
  $con->deleteEndereco($_GET['id']);
}

header('Location: ./enderecos.php');
die();