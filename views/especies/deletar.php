<?php
require_once '../../models/estado.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);

if (isset($_GET['id'])) {
  $con->deleteEspecie($_GET['id']);
}

header('Location: ./especies.php');
die();