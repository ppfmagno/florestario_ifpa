<?php
require_once '../../models/estado.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);

if (isset($_POST['estado'])) {
  $estadoEditado = new Estado($_POST['estado']['id'], $_POST['estado']['nome']);
  $con->updateEstado($estadoEditado);
  header('Location: ./estados.php');
  die();
} elseif (isset($_GET['id'])) {
  $estado = $con->getEstadoById($_GET['id']);
} else {
  header('Location: ./estados.php');
  die();
}
?>
<?php include_once '../partials/header.php';?>

<h1>Estado</h1>
<h2>Editar (Update)</h2>
<h3>Estado <?php echo $estado['id_estado'] ?> - <?php echo $estado['nome'] ?></h3>
<form method="post">
  <input type="text" name="estado[nome]" placeholder="novo nome" value="<?php echo $estado['nome'] ?>">
  <input type="hidden" name="estado[id]" value=<?php echo $estado['id_estado']?>>
  <input type="submit" value="Modificar">
</form>

<?php include_once '../partials/footer.php'; ?>