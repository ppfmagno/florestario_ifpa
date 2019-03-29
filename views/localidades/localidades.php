<?php
require_once '../../models/localidade.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);
$municipios = $con->getMunicipios();

if (!empty($_POST['localidade']['longitude']) AND !empty($_POST['localidade']['latitude']) AND !empty($_POST['localidade']['id_municipio'])) {
  $novaLocalidade = new Localidade(
    null,
    $_POST['localidade']['longitude'],
    $_POST['localidade']['latitude'],
    $_POST['localidade']['id_municipio']
  );
  $con->insertLocalidade($novaLocalidade);
}

?>
<?php include_once '../partials/header.php'; ?>
<?php include_once '../partials/menu.php'; ?>

<h1>Localidade</h1>
<h2>Inserir (Create)</h2>
<form method="post">
  <input type="text" name="localidade[longitude]" placeholder="longitude">
  <input type="text" name="localidade[latitude]" placeholder="latitude">
  <select name="localidade[id_municipio]">
    <option value="">Município</option>
    <?php foreach ($municipios as $key => $municipio) { ?>
      <option value="<?php echo $municipio['id_municipio']; ?>"><?php echo $municipio['nome'] ?></option>
    <?php } ?>
  </select>
  <input type="submit" value="Inserir">
</form>

<hr>

<h2>Ler (Read)</h2>
<table>
  <tr>
    <th>id</th>
    <th>longitude</th>
    <th>latitude</th>
    <th>município</th>
    <th>editar</th>
    <th>deletar</th>
  </tr>
  <?php
    $localidades = $con->getLocalidades();
    foreach ($localidades as $key => $localidade) {
      $municipioDaLocalidade = $con->getMunicipioById($localidade['municipio_id_municipio']);
  ?>
  <tr>
    <td><?php echo $localidade['id_localidade']?></td>
    <td><?php echo $localidade['longitude']?></td>
    <td><?php echo $localidade['latitude']?></td>
    <td><?php echo $municipioDaLocalidade['nome']?></td>
    <td><a href="./editar.php?id=<?php echo $localidade['id_localidade'] ?>">editar</a></td>
    <td><a href="./deletar.php?id=<?php echo $localidade['id_localidade'] ?>">deletar</a></td>
  </tr>
  <?php
    }
  ?>
</table>

<?php include_once '../partials/footer.php'; ?>