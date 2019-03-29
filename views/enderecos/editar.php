<?php
require_once '../../models/endereco.php';
require_once '../../models/municipio.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);

if (!empty($_POST['endereco']['rua']) AND !empty($_POST['endereco']['numero'])
  AND !empty($_POST['endereco']['bairro']) AND !empty($_POST['endereco']['cep'])
  AND !empty($_POST['endereco']['id_municipio'])) {
  $enderecoEditado = new Endereco($_POST['endereco']['id'], $_POST['endereco']['rua'], $_POST['endereco']['cep'], $_POST['endereco']['numero'], $_POST['endereco']['bairro'], $_POST['endereco']['id_municipio']);
  $con->updateEndereco($enderecoEditado);
  header('Location: ./enderecos.php');
  die();
} elseif (isset($_GET['id'])) {
  $endereco = $con->getEnderecoById($_GET['id']);
  $enderecoMunicipio = $con->getMunicipioById($endereco['municipio_id_municipio']);
  $municipios = $con->getMunicipios();
} else {
  header('Location: ./enderecos.php');
  die();
}
?>
<?php include_once '../partials/header.php'; ?>
<?php include_once '../partials/menu.php'; ?>

<h1>Endereço</h1>
<h2>Editar (Update)</h2>
<h3>Endereço <?php echo $endereco['id_endereco'] ?> - <?php echo $endereco['rua'] . ' ' . $endereco['numero'] ?></h3>
<form method="post">
  <input type="text" name="endereco[rua]" value="<?php echo $endereco['rua'] ?>">
  <input type="text" name="endereco[numero]" value="<?php echo $endereco['numero'] ?>">
  <input type="text" name="endereco[bairro]" value="<?php echo $endereco['bairro'] ?>">
  <input type="text" name="endereco[cep]" value="<?php echo $endereco['cep'] ?>">
  <select name="endereco[id_municipio]">
    <option value="<?php echo $enderecoMunicipio['id_municipio']?>"><?php echo $enderecoMunicipio['nome']?></option>
    <?php foreach ($municipios as $key => $municipio) { ?>
      <option value="<?php echo $municipio['id_municipio']; ?>"><?php echo $municipio['nome']; ?></option>
    <?php } ?>
  </select>
  <input type="hidden" name="endereco[id]" value="<?php echo $endereco['id_endereco']?>">
  <input type="submit" value="Modificar">
</form>

<?php include_once '../partials/footer.php'; ?>
