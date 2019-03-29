<?php
require_once '../../models/localidade.php';
require_once '../../models/dbcontrole.php';

if (!empty($_POST['localidade']['longitude']) AND !empty($_POST['localidade']['latitude']) AND !empty($_POST['localidade']['id_municipio'])) {
  $dbconfig = parse_ini_file('../../dbconfig.ini');
  $con = new DBcontrole($dbconfig);
  $localidadeEditada = new Localidade(
    $_POST['localidade']['id'],
    $_POST['localidade']['longitude'],
    $_POST['localidade']['latitude'],
    $_POST['localidade']['id_municipio']
  );
  $con->updateLocalidade($localidadeEditada);
  header('Location: ./localidades.php');
  die();
} elseif (isset($_GET['id'])) {
  $dbconfig = parse_ini_file('../../dbconfig.ini');
  $con = new DBcontrole($dbconfig);
  $localidade = $con->getLocalidadeById($_GET['id']);
  $municipios = $con->getMunicipios();
  $municipioDaLocalidade;
  foreach ($municipios as $key => $municipio) {
    if ($municipio['id_municipio'] == $localidade['municipio_id_municipio']) {
      $municipioDaLocalidade = $municipio;
    }
  }
} else {
  header('Location: ./localidades.php');
  die();
}

?>
<?php include_once '../partials/header.php'; ?>
<?php include_once '../partials/menu.php'; ?>

<h1>Localidade</h1>
<h2>Editar (Update)</h2>
<h3>Localidade <?php echo $localidade['id_localidade'] ?></h3>
<form method="post">
  <input type="text" name="localidade[longitude]" value="<?php echo $localidade['longitude'] ?>">
  <input type="text" name="localidade[latitude]" value="<?php echo $localidade['latitude'] ?>">
  <select name="localidade[id_municipio]">
    <option value="<?php echo $localidade['municipio_id_municipio'] ?>"><?php echo $municipioDaLocalidade['nome'] ?></option>
    <?php foreach ($municipios as $key => $municipio) { ?>
      <option value="<?php echo $municipio['id_municipio']; ?>"><?php echo $municipio['nome'] ?></option>
    <?php } ?>
  </select>
  <input type="hidden" name="localidade[id]" value="<?php echo $localidade['id_localidade'] ?>">
  <input type="submit" value="Inserir">
</form>

<?php include_once '../partials/footer.php'; ?>