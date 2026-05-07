<?php
require_once 'conexao.php';



$id = $_POST['id'];
$bimestre = $_POST['bimestre'];
$nota1 = $_POST['nota1'];
$nota2 = $_POST['nota2'];
$nota3 = $_POST['nota3'];
$peso = $_POST['peso'];
$faltas = $_POST['faltas'];

// SQL SEM o aluno_id (já que ele não muda)
$sql = "UPDATE notas_alunos SET 
        bimestre = '$bimestre', 
        nota1 = '$nota1', 
        nota2 = '$nota2', 
        nota3 = '$nota3', 
        peso = '$peso', 
        faltas = '$faltas' 
        WHERE id = '$id'";

if(mysqli_query($conn, $sql)) {
    header("Location: notas_index.php" . "?msg=atualizado");  /* Redireciona com mensagem de sucesso */
  
    exit;
} else {
    echo "Erro ao atualizar: " . mysqli_error($conn);
}
