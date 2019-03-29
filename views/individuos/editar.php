<?php
require_once '../../models/individuo.php';
require_once '../../models/dbcontrole.php';

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);

if (!empty($_POST['individuo']['circunferencia_copa'])
        AND !empty($_POST['individuo']['circunferencia_altura_peito'])
        AND !empty($_POST['individuo']['especie'])) {
    $individuoAlterado = new Individuo($_POST['individuo']['id_individuo'], 
            $_POST['individuo']['circunferencia_copa'], 
            $_POST['individuo']['circunferencia_altura_peito'], 
            empty($_POST['individuo']['oco']) ? 0 : 1, 
            null, 
            null, 
            $_POST['individuo']['especie'], 
            $_POST['pragas']);

    $con->updateIndividuo($individuoAlterado);
    header('Location: ./individuos.php');
    die();
} else if (isset($_GET['id'])) {
    $individuo = $con->getIndividuoById($_GET['id']);
    $individuoEspecie = $con->getEspecieById($individuo['especie_id_especie']);
    $especies = $con->getEspecies();
} else {
    header('Location: ./individuos.php');
    die();
}
?>
<?php include_once '../partials/header.php'; ?>
<?php include_once '../partials/menu.php'; ?>

<h1>Indivíduos</h1>
<h2>Editar (Update)</h2>
<h3>Indivíduo <?php echo $individuo['id_individuo'] ?> - <?php echo $individuoEspecie['nome_cientifico'] ?></h3>
<form method="post">
    <input type="number" step=".01" name="individuo[circunferencia_copa]" placeholder="Circunferencia da Copa" value="<?php echo $individuo['circunferencia_copa'] ?>">
    <input type="number" step=".01" name="individuo[circunferencia_altura_peito]" placeholder="Altura da Altura do Peito" value="<?php echo $individuo['circunferencia_altura_peito'] ?>">
    <div>
        <label for="oco">Oco</label>
        <input type="checkbox" id="oco" name="individuo[oco]" <?php echo $individuo['oco'] == '1' ? 'checked' : '' ?> value="1">
    </div>
    <select name="individuo[especie]">
        <option value="<?php echo $individuoEspecie['id_especie']; ?>"><?php echo $individuoEspecie['nome_cientifico']; ?></option>
<?php foreach ($especies as $key => $especie) { ?>
            <option value="<?php echo $especie['id_especie']; ?>"><?php echo $especie['nome_cientifico']; ?></option>
<?php } ?>
    </select>
    <input type="hidden" name="individuo[id_individuo]" value=<?php echo $individuo['id_individuo'];?>>
    <input type="submit" value="Modificar">
</form>


<?php include_once '../partials/footer.php'; ?>


