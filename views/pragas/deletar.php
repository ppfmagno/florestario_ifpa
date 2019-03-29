<?php
require_once '../../models/praga.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);

if (isset($_GET['id'])) {
  $con->deletePraga($_GET['id']);
}

header('Location: ./pragas.php');
die();