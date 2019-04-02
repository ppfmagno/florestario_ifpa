<?php

require_once '../../../models/dbcontrole.php';
require_once '../../../models/nomepopularespecie.php';

$dbconfig = parse_ini_file('../../../dbconfig.ini');
$con = new DBcontrole($dbconfig);

if (isset($_POST['novo_nome_popular'])) {
  $novonomepopular = new NomePopularEspecie(null, $_POST['novo_nome_popular']['nome'], $_POST['novo_nome_popular']['especie_id_especie']);
  $con->insertNomePopular($novonomepopular);
}

header('Location: ../editar.php');
exit;

