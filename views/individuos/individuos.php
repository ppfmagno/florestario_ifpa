<?php
    
    require_once '../../models/individuo.php';
    require_once '../../models/dbcontrole.php';
    
    $dbconfig = parse_ini_file('../../dbconfig.ini');
    $con = new DBcontrole($dbconfig);
    $especies = $con->getEspecies();
    
    if (!empty($_POST['novo_individuo']['circunferencia_copa'])
            AND !empty($_POST['novo_individuo']['circunferencia_altura_peito'])
            AND !empty($_POST['novo_individuo']['especie'])) {
        $novoindividuo = new Individuo(
                null, 
                $_POST['novo_individuo']['circunferencia_copa'], 
                $_POST['novo_individuo']['circunferencia_altura_peito'], 
                empty($_POST['novo_individuo']['oco']) ? 0 : 1,
                null,
                null,
                $_POST['novo_individuo']['especie'],
                null);
        $con->insertIndividuo($novoindividuo);
    }

?>
<?php include_once '../partials/header.php'; ?>
<?php include_once '../partials/menu.php'; ?>

<h1>Indivíduo</h1>
<h2>Inserir (Create)</h2>
<form method="post">
    <input type="number" step=".01" name="novo_individuo[circunferencia_copa]" placeholder="Circunferencia da Copa">
    <input type="number" step=".01" name="novo_individuo[circunferencia_altura_peito]" placeholder="Altura da Altura do Peito">
    <div>
        <label for="oco">Oco</label>
        <input type="checkbox" id="oco" name="novo_individuo[oco]" value="1">
    </div>
    <select name="novo_individuo[especie]">
        <option value="">Especie</option>
        <?php foreach ($especies as $key => $especie){?>
        <option value="<?php echo $especie['id_especie']; ?>"><?php echo $especie['nome_cientifico']; ?></option>
        <?php } ?>
    </select>
  <input type="submit" value="Inserir">
</form>

<hr/>

<h2>Ler (Read)</h2>
<table>
  <tr>
    <th>id</th>
    <th>Circunferencia da Copa</th>
    <th>Circunferencia da Altura do Peiro</th>
    <th>Oco</th>
    <th>Data da Criação</th>
    <th>Data da Última Alteração</th>
    <th>editar</th>
    <th>deletar</th>
  </tr>
  <?php
    $individuos = $con->getIndividuos();
    foreach ($individuos as $key => $individuo) {
  ?>
  <tr>
    <td><?php echo $individuo['id_individuo'] ?></td>
    <td><?php echo $individuo['circunferencia_copa'] ?></td>
    <td><?php echo $individuo['circunferencia_altura_peito'] ?></td>
    <td><?php echo ($individuo['oco'] == '1' ? 'Sim' : 'Não') ?></td>
    <td><?php echo $individuo['data_criacao'] ?></td>
    <td><?php echo $individuo['data_modificacao'] ?></td>
    <td><a href="./editar.php?id=<?php echo $individuo['id_individuo'] ?>">editar</a></td>
    <td><a href="./deletar.php?id=<?php echo $individuo['id_individuo'] ?>">deletar</a></td>
  </tr>
  <?php
    }
  ?>
</table>

<?php include_once '../partials/footer.php'; ?>