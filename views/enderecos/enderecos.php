<?php
require_once '../../models/endereco.php';
require_once '../../models/municipio.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);
$municipios = $con->getMunicipios();

if (!empty($_POST['novo_endereco']['rua']) AND !empty($_POST['novo_endereco']['numero'])
  AND !empty($_POST['novo_endereco']['bairro']) AND !empty($_POST['novo_endereco']['cep'])
  AND !empty($_POST['novo_endereco']['id_municipio'])) {
    $novoEndereco = new Endereco(null, $_POST['novo_endereco']['rua'], $_POST['novo_endereco']['cep'], $_POST['novo_endereco']['numero'], $_POST['novo_endereco']['bairro'], $_POST['novo_endereco']['id_municipio']);
    $con->insertEndereco($novoEndereco);
}

?>
<?php include_once '../partials/header.php'; ?>
<?php include_once '../partials/menu.php'; ?>

<h1>Endereço</h1>
<h2>Inserir (Create)</h2>
<form method="post">
  <input type="text" name="novo_endereco[rua]" placeholder="rua">
  <input type="text" name="novo_endereco[numero]" placeholder="número">
  <input type="text" name="novo_endereco[bairro]" placeholder="bairro">
  <input type="text" name="novo_endereco[cep]" placeholder="cep">
  <select name="novo_endereco[id_municipio]">
    <option value="">Município</option>
    <?php foreach ($municipios as $key => $municipio) { ?>
      <option value="<?php echo $municipio['id_municipio']; ?>"><?php echo $municipio['nome']; ?></option>
    <?php } ?>
  </select>
  <input type="submit" value="Inserir">
</form>

<hr>

<h2>Ler (Read)</h2>
<table>
  <tr>
    <th>id</th>
    <th>rua</th>
    <th>número</th>
    <th>bairro</th>
    <th>cep</th>
    <th>município</th>
    <th>editar</th>
    <th>deletar</th>
  </tr>
  <?php
    $enderecos = $con->getEnderecos();
    foreach ($enderecos as $key => $endereco) {
      $municipioDoEndereco = $con->getMunicipioById($endereco['municipio_id_municipio']);
  ?>
  <tr>
    <td><?php echo $endereco['id_endereco']?></td>
    <td><?php echo $endereco['rua']?></td>
    <td><?php echo $endereco['numero']?></td>
    <td><?php echo $endereco['bairro']?></td>
    <td><?php echo $endereco['cep']?></td>
    <td><?php echo $municipioDoEndereco['nome'] ?></td>
    <td><a href="./editar.php?id=<?php echo $endereco['id_endereco'] ?>">editar</a></td>
    <td><a href="./deletar.php?id=<?php echo $endereco['id_endereco'] ?>">deletar</a></td>
  </tr>
  <?php
    }
  ?>
</table>

<?php include_once '../partials/footer.php'; ?>