<?php
require_once '../../models/individuo.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);

if (isset($_GET['id'])) {
  $con->deleteIndividuo($_GET['id']);
}


header('Location: ./individuos.php');
die();