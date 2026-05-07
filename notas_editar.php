<?php
require_once 'conexao.php';
include 'includes/header.php'; // Inclui o header com o layout e navbar

// Pega o ID da nota a ser editada
$id = $_GET['id'] ?? null; 

// Verificação de segurança: se não tiver ID, volta para a lista
if (!$id) {
    header("Location: notas_index.php");
    exit;
}

// inner join para pegar o nome do aluno junto com os dados da nota (para mostrar no campo de aluno, que é readonly)
$sql = "SELECT n.*, u.nome 
        FROM notas_alunos n 
        INNER JOIN usuarios u ON n.aluno_id = u.id 
        WHERE n.id = '$id'";

$res = mysqli_query($conn, $sql);
$dados = mysqli_fetch_assoc($res);
?>

  

<h2>Editar Nota</h2>

<form action="notas_atualizar.php" method="POST">
  <input type="hidden" name="id" value="<?= $dados['id'] ?>">

  Aluno: <br>
 <input type="hidden" name="aluno_id" value="<?= $dados['aluno_id'] ?>">
 <input type="text" name="aluno" value="<?= $dados['nome'] ?>" readonly><br><br> 
  
 Bimestre: <br>
  <input type="text" name="bimestre" value="<?= $dados['bimestre'] ?>"><br><br>

  Nota 1: <br>
  <input type="text" name="nota1" value="<?= $dados['nota1'] ?>"><br><br>

  Nota 2: <br>
  <input type="text" name="nota2" value="<?= $dados['nota2'] ?>"><br><br>

  Nota 3: <br>
  <input type="text" name="nota3" value="<?= $dados['nota3'] ?>"><br><br>

  Peso: <br>
  <input type="text" name="peso" value="<?= $dados['peso'] ?>"><br><br>

  Faltas: <br>
  <input type="text" name="faltas" value="<?= $dados['faltas'] ?>"><br><br>


  <button type="submit">Atualizar</button>
</form>
