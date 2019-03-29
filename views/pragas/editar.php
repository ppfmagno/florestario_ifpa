<?php
require_once '../../models/praga.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);

if (isset($_POST['praga'])) {
  $pragaEditada = new Praga($_POST['praga']['id_praga'], $_POST['praga']['nome_cientifico'], null);
  $con->updatePraga($pragaEditada);
  header('Location: ./pragas.php');
  die();
} elseif (isset($_GET['id'])) {
  $praga = $con->getPragaById($_GET['id']);
} else {
  header('Location: ./pragas.php');
  die();
}
?>
<?php include_once '../partials/header.php';?>

<h1>Praga</h1>
<h2>Editar (Update)</h2>
<h3>Praga <?php echo $praga['id_praga'] ?> - <?php echo $praga['nome_cientifico'] ?></h3>
<form method="post">
  <input type="text" name="praga[nome_cientifico]" placeholder="novo nome" value="<?php echo $praga['nome_cientifico'] ?>">
  <input type="hidden" name="praga[id_praga]" value=<?php echo $praga['id_praga']?>>
  <input type="submit" value="Modificar">
</form>

<?php include_once '../partials/footer.php'; ?>