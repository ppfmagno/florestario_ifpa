<?php
require_once '../../models/estado.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);

if (isset($_POST['novo_estado'])) {
  $novoEstado = new Estado(null, $_POST['novo_estado']['nome']);
  $con->insertEstado($novoEstado);
}
?>
<?php include_once '../partials/header.php'; ?>
<?php include_once '../partials/menu.php'; ?>

<h1>Estado</h1>
<h2>Inserir (Create)</h2>
<form method="post">
  <input type="text" name="novo_estado[nome]" placeholder="nome">
  <input type="submit" value="Inserir">
</form>

<hr/>

<h2>Ler (Read)</h2>
<table>
  <tr>
    <th>id</th>
    <th>nome</th>
    <th>editar</th>
    <th>deletar</th>
  </tr>
  <?php
    $estados = $con->getEstados();
    foreach ($estados as $key => $estado) {
  ?>
  <tr>
    <td><?php echo $estado['id_estado'] ?></td>
    <td><?php echo $estado['nome'] ?></td>
    <td><a href="./editar.php?id=<?php echo $estado['id_estado'] ?>">editar</a></td>
    <td><a href="./deletar.php?id=<?php echo $estado['id_estado'] ?>">deletar</a></td>
  </tr>
  <?php
    }
  ?>
</table>


<?php include_once '../partials/footer.php'; ?>