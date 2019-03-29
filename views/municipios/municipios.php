<?php
require_once '../../models/municipio.php';
require_once '../../models/estado.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);
$estados = $con->getEstados();

if (!empty($_POST['novo_municipio']['nome']) AND !empty($_POST['novo_municipio']['id_estado'])) {
  $novoMunicipio = new Municipio(null, $_POST['novo_municipio']['nome'], $_POST['novo_municipio']['id_estado']);
  $con->insertMunicipio($novoMunicipio);
}
?>
<?php include_once '../partials/header.php'; ?>
<?php include_once '../partials/menu.php'; ?>

<h1>Município</h1>
<h2>Inserir (Create)</h2>
<form method="post">
  <input type="text" name="novo_municipio[nome]" placeholder="nome">
  <select name="novo_municipio[id_estado]">
    <option value="">Estado</option>
    <?php foreach ($estados as $key => $estado) { ?>
      <option value="<?php echo $estado['id_estado']; ?>"><?php echo $estado['nome']; ?></option>
    <?php } ?>
  </select>
  <input type="submit" value="Inserir">
</form>

<hr>

<h2>Ler (Read)</h2>
<table>
  <tr>
    <th>id</th>
    <th>nome</th>
    <th>estado</th>
    <th>editar</th>
    <th>deletar</th>
  </tr>
  <?php
    $municipios = $con->getMunicipios();
    foreach ($municipios as $key => $municipio) {
      $estadoDoMunicipio = $con->getEstadoById($municipio['estado_id_estado']);
  ?>
  <tr>
    <td><?php echo $municipio['id_municipio'] ?></td>
    <td><?php echo $municipio['nome'] ?></td>
    <td><?php echo $estadoDoMunicipio['nome'] ?></td>
    <td><a href="./editar.php?id=<?php echo $municipio['id_municipio'] ?>">editar</a></td>
    <td><a href="./deletar.php?id=<?php echo $municipio['id_municipio'] ?>">deletar</a></td>
  </tr>
  <?php
    }
  ?>
</table>

<?php include_once '../partials/footer.php'; ?>