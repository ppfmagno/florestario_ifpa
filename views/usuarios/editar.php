<?php
require_once '../../models/usuario.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);

if (!empty($_POST['usuario']['nome'])
AND !empty($_POST['usuario']['login'])
AND !empty($_POST['usuario']['email'])
AND !empty($_POST['usuario']['senha'])
AND !empty($_POST['usuario']['crea'])
AND !empty($_POST['usuario']['id_endereco'])) {
  $usuaioEdidato = new Usuario(
    $_POST['usuario']['id'],
    $_POST['usuario']['nome'],
    $_POST['usuario']['login'],
    $_POST['usuario']['email'],
    $_POST['usuario']['senha'],
    $_POST['usuario']['crea'],
    $_POST['usuario']['id_endereco'],
    null
  );
  $con->updateUsuario($usuaioEdidato);
  header('Location: ./usuarios.php');
  die();
} elseif (isset($_GET['id'])) {
  $usuaio = $con->getUsuarioById($_GET['id']);
  $enderecoDoUsuario = $con->getEnderecoById($usuaio['endereco_id_endereco']);
  $municipioDoUsuario = $con->getMunicipioById($enderecoDoUsuario['municipio_id_municipio']);
  $enderecos = $con->getEnderecos();
} else {
  header('Location: ./usuarios.php');
  die();
}

?>
<?php include_once '../partials/header.php'; ?>
<?php include_once '../partials/menu.php'; ?>

<h1>Usuário</h1>
<h2>Editar (Update)</h2>
<h3>Usuário <?php echo $usuaio['id_usuaio'] ?> - <?php echo $usuaio['nome'] . ' ' . $usuaio['login'] ?></h3>
<form method="post">
  <input type="text" name="usuario[nome]" value="<?php echo $usuaio['nome'] ?>">
  <input type="text" name="usuario[login]" value="<?php echo $usuaio['login'] ?>">
  <input type="email" name="usuario[email]" value="<?php echo $usuaio['email'] ?>">
  <input type="password" name="usuario[senha]" value="<?php echo $usuaio['senha'] ?>">
  <input type="text" name="usuario[crea]" value="<?php echo $usuaio['crea'] ?>">
  <select name="usuario[id_endereco]">
    <option value="<?php echo $usuaio['endereco_id_endereco'] ?>"><?php echo $enderecoDoUsuario['rua'] ?> <?php echo $enderecoDoUsuario['numero'] ?>, <?php echo $municipioDoUsuario['nome'] ?></option>
    <?php foreach ($enderecos as $key => $endereco) {
      $municipio = $con->getMunicipioById($endereco['municipio_id_municipio']);
    ?>
      <option value="<?php echo $endereco['id_endereco']; ?>"><?php echo $endereco['rua'] ?> <?php echo $endereco['numero'] ?>, <?php echo $municipio['nome'] ?></option>
    <?php } ?>
  </select>
  <input type="hidden" name="usuario[id]" value="<?php echo $usuaio['id_usuario'] ?>">
  <input type="submit" value="Inserir">
</form>

<?php include_once '../partials/footer.php'; ?>