<?php
require_once '../../models/inventario.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);
$localidades = $con->getLocalidades();
$usuarios = $con->getUsuarios();

if (!empty($_POST['inventario']['id_usuario'])
AND !empty($_POST['inventario']['nome'])
AND !empty($_POST['inventario']['id_localidade'])) {
  $novoInventario = new Inventario(
    null,
    $_POST['inventario']['nome'],
    null,
    null,
    $_POST['inventario']['id_localidade'],
    null,
    $_POST['inventario']['id_usuario']
  );
  $con->insertInventario($novoInventario);
}

?>
<?php include_once '../partials/header.php'; ?>
<?php include_once '../partials/menu.php'; ?>

<h1>Inventários</h1>
<h2>Inserir (Create)</h2>
<form method="post">
  <select name="inventario[id_usuario]">
    <option value="">Dono do projeto</option>
    <?php foreach ($usuarios as $key => $usuario) { ?>
      <option value="<?php echo $usuario['id_usuario']; ?>"><?php echo $usuario['nome']?></option>
    <?php } ?>
  </select>
  <input type="text" name="inventario[nome]" placeholder="nome do projeto">
  <select name="inventario[id_localidade]">
    <option value="">Localidade</option>
    <?php foreach ($localidades as $key => $localidade) {
      $municipioDaLocalidade = $con->getMunicipioById($localidade['municipio_id_municipio']);
    ?>
      <option value="<?php echo $localidade['id_localidade']; ?>"><?php echo $localidade['longitude'] . ' - ' . $localidade['latitude'] . ' - ' . $municipioDaLocalidade['nome']?></option>
    <?php } ?>
  </select>
  <input type="submit" value="Inserir">
</form>

<hr>

<h2>Ler (Read)</h2>
<table>
  <tr>
    <th>id</th>
    <th>dono do projeto</th>
    <th>nome do projeto</th>
    <th>data da última modificação</th>
    <th>data da criação</th>
    <th>localidade</th>
    <th>editar</th>
    <th>deletar</th>
  </tr>
  <?php
    
    $inventarios = $con->getInventarios();
    foreach ($inventarios as $key => $inventario) {
      $donoDoInventario = $con->getUsuarioById($inventario['usuario_id_usuario']);
      $localidadeDoInventario = $con->getLocalidadeById($inventario['localidade_id_localidade']);
      $municipioDaLocalidadeDoInventario = $con->getMunicipioById($localidadeDoInventario['municipio_id_municipio']);
  ?>
  <tr>
    <td><?php echo $inventario['id_inventario']?></td>
    <td><?php echo $donoDoInventario['nome']?></td>
    <td><?php echo $inventario['nome_do_projeto']?></td>
    <td><?php echo $inventario['data_modificacao']?></td>
    <td><?php echo $inventario['data_criacao']?></td>
    <td><?php echo $localidadeDoInventario['longitude'] . ' - ' . $localidadeDoInventario['latitude'] . ' - ' . $municipioDaLocalidadeDoInventario['nome'] ?></td>
    <td><a href="./editar.php?id=<?php echo $inventario['id_inventario'] ?>">editar</a></td>
    <td><a href="./deletar.php?id=<?php echo $inventario['id_inventario'] ?>">deletar</a></td>
  </tr>
  <?php
    }
  ?>
</table>

<?php include_once '../partials/footer.php'; ?>