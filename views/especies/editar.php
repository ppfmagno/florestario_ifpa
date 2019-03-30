<?php

session_start();

require_once '../../models/especie.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);

if (isset($_POST['especie'])) {
    $especieEditada = new Especie($_POST['especie']['id'], $_POST['especie']['nome_cientifico'], null);
    $con->updateEspecie($especieEditada);
    unset($_SESSION['id_especie']);
    header('Location: ./especies.php');
    die();
} elseif (isset($_GET['id'])) {
    $_SESSION['id_especie'] = $_GET['id'];
    $especie = $con->getEspecieById($_GET['id']);
    $especie['nomes_populares'] = $con->getNomesPopulasByIdEspecie($especie['id_especie']);
} else if (isset($_SESSION['id_especie'])) {
    $especie = $con->getEspecieById($_SESSION['id_especie']);
    $especie['nomes_populares'] = $con->getNomesPopulasByIdEspecie($especie['id_especie']);
} else {
    header('Location: ./especies.php');
    die();
}
?>
<?php include_once '../partials/header.php'; ?>
<?php include_once '../partials/menu.php'; ?>

<h1>Espécie</h1>
<h2>Alterar (Update)</h2>
<h3>Espécie <?php echo $especie['id_especie'] ?> - <?php echo $especie['nome_cientifico'] ?></h3>
<form method="post">
    <input type="text" name="especie[nome_cientifico]" placeholder="novo nome cientifíco" value="<?php echo $especie['nome_cientifico'] ?>">
    <input type="hidden" name="especie[id]" value=<?php echo $especie['id_especie'] ?>>
    <input type="submit" value="Modificar">
</form>
<hr/>
<form method="post" action="nomepopular/inserir.php">
    <input type="hidden" name="novo_nome_popular[especie_id_especie]" value="<?php echo $especie['id_especie']; ?>">
    <input type="text" name="novo_nome_popular[nome]" placeholder="Nome Popular">
    <input type="submit" value="Adicionar Nome Popular">
</form>
<table>
    <tr>
        <th>id</th>
        <th>Nome Popular</th>
        <th>deletar</th>
    </tr>
    <?php
    foreach ($especie['nomes_populares'] as $key => $nome_popular) {
        ?>
        <tr>
            <td><?php echo $nome_popular['id_nome_popular_especie']; ?></td>
            <td><?php echo $nome_popular['nome']; ?></td>
            <td><a href="./nomepopular/deletar.php?id=<?php echo $nome_popular['id_nome_popular_especie']; ?>">deletar</a></td>
        </tr>
        <?php
    }
    ?>
</table>

<?php include_once '../partials/footer.php'; ?>