<?php
include 'conexao.php';

//Variavel usada no <title> da pagina ( header.php)
$pageTitle = "Usuários Cadastrados";

//inclui no topo da pagina (HTML Inicial + navbar)
include 'includes/header.php';
?>

<div class="d-flex align-items-center justify-content-between mb-3">
<h2 class="mb-0">Usuários</h2>

  <a href="form.php" class="btn btn-success"> 
  <i class="bi bi-plus-circle me-1">Novo</i>
  </a>
</div>

<!-- <h2>Usuários</h2>

<a href="form.php">Novo</a><br><br> -->

<table class="table table-hover">
  <tr>
    <th>Nome</th>
    <th>Email</th>
    <th>Telefone</th>
    <th>Idade</th>
    <th>Cidade</th>
    <th>Curso</th>
    <th class="text-center">Ações</th>
  </tr>

<?php
$res = mysqli_query($conn, "SELECT * FROM usuarios");

while ($r = mysqli_fetch_assoc($res)){
  echo "<tr>
    <td>{$r['nome']}</td>
    <td>{$r['email']}</td>
    <td>{$r['telefone']}</td>
    <td>{$r['idade']}</td>
    <td>{$r['cidade']}</td>
    <td>{$r['curso']}</td>
    <td>
      <a href='editar.php?id={$r['id']}'><i class='bi bi-pencil'></i></a> |
      <a href='deletar.php?id={$r['id']}' onclick='return confirm(\"Tem certeza que deseja excluir?\")'><i class='bi bi-trash3'></i></a>
    </td>
  </tr>";
}
?>

</table>

<?php include 'includes/footer.php' ?>