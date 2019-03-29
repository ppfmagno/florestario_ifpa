<?php
require_once '../../models/municipio.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);

if (isset($_GET['id'])) {
  $con->deleteMunicipio($_GET['id']);
}

header('Location: ./municipios.php');
die();