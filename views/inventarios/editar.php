<?php
require_once '../../models/inventario.php';
require_once '../../models/dbcontrole.php';


if (!empty($_POST['inventario']['id_usuario'])
AND !empty($_POST['inventario']['nome'])
AND !empty($_POST['inventario']['id_localidade'])) {
  $dbconfig = parse_ini_file('../../dbconfig.ini');
  $con = new DBcontrole($dbconfig);
  $inventarioAtualizado = new Inventario(
    $_POST['inventario']['id'],
    $_POST['inventario']['nome'],
    null,
    null,
    $_POST['inventario']['id_localidade'],
    null,
    $_POST['inventario']['id_usuario']
  );
  $con->updateInventario($inventarioAtualizado);
  header('Location: ./inventarios.php');
  die();
} elseif (isset($_GET['id'])) {
  $dbconfig = parse_ini_file('../../dbconfig.ini');
  $con = new DBcontrole($dbconfig);
  $localidades = $con->getLocalidades();
  $usuarios = $con->getUsuarios();
  $inventario = $con->getInventarioById($_GET['id']);
  $donoDoInventario = $con->getUsuarioById($inventario['usuario_id_usuario']);
  $localidadeDoInventario = $con->getLocalidadeById($inventario['localidade_id_localidade']);
  $municipioDaLocalidadeDoInventario = $con->getMunicipioById($localidadeDoInventario['municipio_id_municipio']);
} else {
  header('Location: ./inventarios.php');
  die();
}

?>
<?php include_once '../partials/header.php'; ?>
<?php include_once '../partials/menu.php'; ?>

<h1>Inventário</h1>
<h2>Editar (Update)</h2>
<form method="post">
  <select name="inventario[id_usuario]">
    <option value="<?php echo $inventario['usuario_id_usuario']; ?>"><?php echo $donoDoInventario['nome']?></option>
    <?php foreach ($usuarios as $key => $usuario) { ?>
      <option value="<?php echo $usuario['id_usuario']; ?>"><?php echo $usuario['nome']?></option>
    <?php } ?>
  </select>
  <input type="text" name="inventario[nome]" value="<?php echo $inventario['nome_do_projeto']?>">
  <select name="inventario[id_localidade]">
    <option value="<?php echo $inventario['localidade_id_localidade'] ?>"><?php echo $localidadeDoInventario['longitude'] . ' - ' . $localidadeDoInventario['latitude'] . ' - ' . $municipioDaLocalidadeDoInventario['nome'] ?></option>
    <?php foreach ($localidades as $key => $localidade) {
      $municipioDaLocalidade = $con->getMunicipioById($localidade['municipio_id_municipio']);
    ?>
      <option value="<?php echo $localidade['id_localidade']; ?>"><?php echo $localidade['longitude'] . ' - ' . $localidade['latitude'] . ' - ' . $municipioDaLocalidade['nome']?></option>
    <?php } ?>
  </select>
  <input type="hidden" name="inventario[id]" value="<?php echo $inventario['id_inventario'] ?>">
  <input type="submit" value="Inserir">
</form>

<?php include_once '../partials/footer.php'; ?>