<?php
    
    require_once '../../models/praga.php';
    require_once '../../models/dbcontrole.php';

    $dbconfig = parse_ini_file('../../dbconfig.ini');
    $con = new DBcontrole($dbconfig);
    $pragas = $con->getPragas();
    
    if (!empty($_POST['nova_praga']['nome_cientifico'])) {
        $novapraga = new Praga(null, $_POST['nova_praga']['nome_cientifico'], null);
        $con->insertPraga($novapraga);
    }
    
?>
<?php include_once '../partials/header.php'; ?>
<?php include_once '../partials/menu.php'; ?>

<h1>Praga</h1>
<h2>Inserir (Create)</h2>
<form method="post">
  <input type="text" name="nova_praga[nome_cientifico]" placeholder="nome">
<!--  <select name="novo_municipio[id_estado]">
    <option value="">Estado</option>
    <?php //foreach ($estados as $key => $estado) { ?>
      <option value="<?php //echo $estado['id_estado']; ?>"><?php //echo $estado['nome']; ?></option>
    <?php //} ?>
  </select>-->
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
    $pragas = $con->getPragas();
    foreach ($pragas as $key => $praga) {
  ?>
  <tr>
    <td><?php echo $praga['id_praga'] ?></td>
    <td><?php echo $praga['nome_cientifico'] ?></td>
    <td><a href="./editar.php?id=<?php echo $praga['id_praga'] ?>">editar</a></td>
    <td><a href="./deletar.php?id=<?php echo $praga['id_praga'] ?>">deletar</a></td>
  </tr>
  <?php
    }
  ?>
</table>

<?php include_once '../partials/footer.php'; ?>

