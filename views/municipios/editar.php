<?php
require_once '../../models/municipio.php';
require_once '../../models/estado.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);

if (!empty($_POST['municipio']['nome']) AND !empty($_POST['municipio']['id_estado'])) {
  $municipioEditado = new Municipio($_POST['municipio']['id'], $_POST['municipio']['nome'], $_POST['municipio']['id_estado']);
  $con->updateMunicipio($municipioEditado);
  header('Location: ./municipios.php');
  die();
} elseif (isset($_GET['id'])) {
  $municipio = $con->getMunicipioById($_GET['id']);
  $municipioEstado = $con->getEstadoById($municipio['estado_id_estado']);
  $estados = $con->getEstados();
} else {
  header('Location: ./estados.php');
  die();
}
?>
<?php include_once '../partials/header.php';?>

<h1>Município</h1>
<h2>Editar (Update)</h2>
<h3>Município <?php echo $municipio['id_municipio'] ?> - <?php echo $municipio['nome'] ?></h3>
<form method="post">
  <input type="text" name="municipio[nome]" placeholder="novo nome" value="<?php echo $municipio['nome'] ?>">
  <select name="municipio[id_estado]">
    <option value="<?php echo $municipioEstado['id_estado'] ?>"><?php echo $municipioEstado['nome'] ?></option>
    <?php foreach ($estados as $key => $estado) { ?>
      <option value="<?php echo $estado['id_estado']; ?>"><?php echo $estado['nome']; ?></option>
    <?php } ?>
  </select>
  <input type="hidden" name="municipio[id]" value=<?php echo $municipio['id_municipio']?>>
  <input type="submit" value="Modificar">
</form>

<?php include_once '../partials/footer.php'; ?>