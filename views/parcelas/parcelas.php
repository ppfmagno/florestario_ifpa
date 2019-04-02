<?php

require_once '../../models/parcela.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);
$parcelas = $con->getParcelas();
$inventarios = $con->getInventarios();

if(!empty($_POST['nova_parcela']['nome']) AND
        !empty($_POST['nova_parcela']['largura']) AND
        !empty($_POST['nova_parcela']['comprimento'])){
    $novaParcela = new Parcela(
            null,
            $_POST['nova_parcela']['nome'],
            $_POST['nova_parcela']['largura'],
            $_POST['nova_parcela']['comprimento'],
            null,
            null,
            $_POST['nova_parcela']['inventario_id_inventario'],
            null);
    
    $con->insertParcela($novaParcela);   
}
?>
<?php include_once '../partials/header.php'; ?>
<?php include_once '../partials/menu.php'; ?>

<h1>Parcela</h1>
<h2>Inserir (Create)</h2>
<form method="post">
  <input type="text" name="nova_parcela[nome]" placeholder="nome">
  <input type="text" type="number" step=".01" name="nova_parcela[largura]" placeholder="largura">
  <input type="text" type="number" step=".01" name="nova_parcela[comprimento]" placeholder="comprimento">
  <select name="nova_parcela[inventario_id_inventario]">
    <option value="">Inventário</option>
    <?php foreach ($inventarios as $key => $inventario) { ?>
      <option value="<?php echo $inventario['id_inventario']; ?>"><?php echo $inventario['nome_do_projeto']; ?></option>
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
    <th>largura</th>
    <th>comprimento</th>
    <th>inventário</th>
    <th>data de criação</th>
    <th>data de modificação</th>
    <th>editar</th>
    <th>deletar</th>
  </tr>
  <?php
    foreach ($parcelas as $key => $parcela) {
      $inventarioDaParcela = $con->getInventarioById($parcela['inventario_id_inventario']);
  ?>
  <tr>
    <td><?php echo $parcela['id_parcela'] ?></td>
    <td><?php echo $parcela['nome_da_parcela'] ?></td>
    <td><?php echo $parcela['largura'] ?></td>
    <td><?php echo $parcela['comprimento'] ?></td>
    <td><?php echo $inventarioDaParcela['nome_do_projeto'] ?></td>
    <td><?php echo $parcela['data_criacao'] ?></td>
    <td><?php echo $parcela['data_modificacao'] ?></td>
    <td><a href="./editar.php?id=<?php echo $parcela['id_parcela'] ?>">editar</a></td>
    <td><a href="./deletar.php?id=<?php echo $parcela['id_parcela'] ?>">deletar</a></td>
  </tr>
  <?php
    }
  ?>
</table>

<?php include_once '../partials/footer.php'; ?>