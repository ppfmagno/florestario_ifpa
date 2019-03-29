<?php
require_once '../../models/usuario.php';
require_once '../../models/endereco.php';
require_once '../../models/dbcontrole.php';

$dbconfig = parse_ini_file('../../dbconfig.ini');
$con = new DBcontrole($dbconfig);
$enderecos = $con->getEnderecos();

if (!empty($_POST['novo_usuario']['nome'])
AND !empty($_POST['novo_usuario']['login'])
AND !empty($_POST['novo_usuario']['email'])
AND !empty($_POST['novo_usuario']['senha'])
AND !empty($_POST['novo_usuario']['crea'])
AND !empty($_POST['novo_usuario']['id_endereco'])) {
  $novoUsuario = new Usuario(
    null,
    $_POST['novo_usuario']['nome'],
    $_POST['novo_usuario']['login'],
    $_POST['novo_usuario']['email'],
    $_POST['novo_usuario']['senha'],
    $_POST['novo_usuario']['crea'],
    $_POST['novo_usuario']['id_endereco'],
    null
  );
  $con->insertUsuario($novoUsuario);
}

?>
<?php include_once '../partials/header.php'; ?>
<?php include_once '../partials/menu.php'; ?>

<h1>Usuário</h1>
<h2>Inserir (Create)</h2>
<form method="post">
  <input type="text" name="novo_usuario[nome]" placeholder="nome">
  <input type="text" name="novo_usuario[login]" placeholder="login">
  <input type="email" name="novo_usuario[email]" placeholder="email">
  <input type="password" name="novo_usuario[senha]" placeholder="senha">
  <input type="text" name="novo_usuario[crea]" placeholder="crea">
  <select name="novo_usuario[id_endereco]">
    <option value="">Endereço</option>
    <?php foreach ($enderecos as $key => $endereco) {
      $municipio = $con->getMunicipioById($endereco['municipio_id_municipio']);
    ?>
      <option value="<?php echo $endereco['id_endereco']; ?>"><?php echo $endereco['rua'] ?> <?php echo $endereco['numero'] ?>, <?php echo $municipio['nome'] ?></option>
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
    <th>login</th>
    <th>email</th>
    <th>crea</th>
    <th>endereço</th>
    <th>editar</th>
    <th>deletar</th>
  </tr>
  <?php
    $usuarios = $con->getUsuarios();
    foreach ($usuarios as $key => $usuario) {
      $enderecoDoUsuario = $con->getEnderecoById($usuario['endereco_id_endereco']);
      $municipioDoUsuario = $con->getMunicipioById($enderecoDoUsuario['municipio_id_municipio']);
  ?>
  <tr>
    <td><?php echo $usuario['id_usuario']?></td>
    <td><?php echo $usuario['nome']?></td>
    <td><?php echo $usuario['login']?></td>
    <td><?php echo $usuario['email']?></td>
    <td><?php echo $usuario['crea']?></td>
    <td><?php echo $enderecoDoUsuario['rua'] ?> <?php echo $enderecoDoUsuario['numero'] ?>, <?php echo $municipioDoUsuario['nome'] ?></td>
    <td><a href="./editar.php?id=<?php echo $usuario['id_usuario'] ?>">editar</a></td>
    <td><a href="./deletar.php?id=<?php echo $usuario['id_usuario'] ?>">deletar</a></td>
  </tr>
  <?php
    }
  ?>
</table>

<?php include_once '../partials/footer.php'; ?>