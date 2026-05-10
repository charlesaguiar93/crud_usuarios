<?php
require_once 'conexao.php';

$aluno_id = $_POST['aluno_id'];
$bimestre = $_POST['bimestre'];
$nota1 = $_POST['nota1'];
$nota2 = $_POST['nota2'];
$nota3 = $_POST['nota3'];
$peso = $_POST['peso'];
$faltas = $_POST['faltas'];
$regexnum =  "/^[0-9]+(\.[0-9]{1,2})?$/"; // Aceita números inteiros ou decimais com até 2 casas (para notas e peso)
$regexfaltas = "/^\d+$/"; // Aceita apenas números inteiros para faltas

/* Validação dos inputs  */
if (!preg_match($regexnum, $nota1) || !preg_match($regexnum, $nota2) || !preg_match($regexnum, $nota3) || !preg_match($regexnum, $peso ) || !preg_match($regexfaltas, $faltas)) {
    echo "<script>alert('Erro: Por favor, insira valores numéricos válidos.'); window.history.back();</script>";/* window.history.back() faz o redirecionamento para a página anterior */
    exit();
}

$sql = "INSERT INTO notas_alunos (aluno_id, bimestre, nota1, nota2, nota3, peso, faltas) 
        VALUES ('$aluno_id', '$bimestre', '$nota1', '$nota2', '$nota3', '$peso', '$faltas')";

if(mysqli_query($conn, $sql)) {
    header("Location: notas_index.php");
} else {
    echo "Erro: " . mysqli_error($conn);
}



/*  Função para calcular médias, faltas e status (pode ser usada tanto para salvar quanto para atualizar) */
function notas_salvar() {
    $nota1 = (float)($_POST['nota1'] ?? 0);
    $nota2 = (float)($_POST['nota2'] ?? 0);
    $nota3 = (float)($_POST['nota3'] ?? 0);
    $peso  = (float)($_POST['peso'] ?? 1);
    $faltas = (int)($_POST['faltas'] ?? 0);

    $mediasimples = ($nota1 + $nota2 + $nota3) / 3;
    $mediaponderada = $mediasimples * $peso;
    $diferencameta = max(0, 7.0 - $mediasimples);





    // Definindo o status para salvar no banco
    if ($mediasimples >= 7.0 && $faltas <= 10) {
        $status = 'Aprovado';
    } elseif ($mediasimples >= 5.0 && $faltas <= 10) {
        $status = 'Recuperação';
    } else {
        $status = 'Reprovado';
    }

    return [
        'media' => $mediasimples,
        'ponderada' => $mediaponderada,
        'falta' => $diferencameta,
        'status' => $status
    ];
}

?>
