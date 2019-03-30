<?php

require_once '../../../models/dbcontrole.php';
require_once '../../../models/nomepopularespecie.php';

$dbconfig = parse_ini_file('../../../dbconfig.ini');
$con = new DBcontrole($dbconfig);

if (isset($_GET['id'])) {
  $con->deletarNomePopular($_GET['id']);
}

header('Location: ../editar.php');
exit;
