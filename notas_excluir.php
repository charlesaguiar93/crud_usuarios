<?php
require_once 'conexao.php';
/* Script para exclusão de notas */
$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "DELETE FROM notas_alunos WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: notas_index.php?msg=excluido");// Redireciona com mensagem de exclusão bem-sucedida
     
    } else {
        echo "Erro ao excluir: " . mysqli_error($conn);
    }
}
exit;
