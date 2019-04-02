<?php

require_once '../../models/parcela.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);

if(!empty($_POST['parcela']['nome']) AND
        !empty($_POST['parcela']['largura']) AND
        !empty($_POST['parcela']['comprimento'])){
    $parcelaAlterada = new Parcela(
            $_POST['parcela']['id_parcela'],
            $_POST['parcela']['nome'],
            $_POST['parcela']['largura'],
            $_POST['parcela']['comprimento'],
            null,
            null,
            $_POST['parcela']['inventario_id_inventario'],
            null);
    $con->updateParcela($parcelaAlterada);
    header('Location: ./parcelas.php');
    die();
}else if(isset($_GET['id'])){
    $parcela = $con->getParcelaById($_GET['id']);
    $parcelaInventario = $con->getInventarioById($parcela['inventario_id_inventario']);
    $inventarios = $con->getInventarios();
}else{
    header('Location: ./parcelas.php');
    die();
}
?>
<?php include_once '../partials/header.php'; ?>
<?php include_once '../partials/menu.php'; ?>

<h1>Parcela</h1>
<h2>Alterar (Update)</h2>
<form method="post">
  <input type="hidden" name="parcela[id_parcela]" value="<?php echo $parcela['id_parcela']; ?>">
  <input type="text" name="parcela[nome]" placeholder="nome" value="<?php echo $parcela['nome_da_parcela']; ?>">
  <input type="text" type="number" step=".01" name="parcela[largura]" placeholder="largura" value="<?php echo $parcela['largura']; ?>">
  <input type="text" type="number" step=".01" name="parcela[comprimento]" placeholder="comprimento" value="<?php echo $parcela['comprimento']; ?>">
  <select name="parcela[inventario_id_inventario]">
    <option value="<?php echo $parcelaInventario['id_inventario'] ?>"><?php echo $parcelaInventario['nome_do_projeto'] ?></option>
    <?php foreach ($inventarios as $key => $inventario) { ?>
      <option value="<?php echo $inventario['id_inventario']; ?>"><?php echo $inventario['nome_do_projeto']; ?></option>
    <?php } ?>
  </select>
  <input type="submit" value="Modificar">
</form>

<?php include_once '../partials/footer.php'; ?>