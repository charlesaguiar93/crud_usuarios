
<?php
include "conexao.php"; // Conecta ao banco

// 1. Pega os dados enviados pelo formulário
$nome = $_GET['busca_nome'] ?? '';
$bimestre = $_GET['busca_bimestre'] ?? '';
$faltas = $_GET['busca_faltas'] ?? '';


// 2. Monta a SQL dinâmica
$sql = "SELECT n.*, u.nome FROM notas_alunos n 
        INNER JOIN usuars u ON n.aluno_id = u.id 
        WHERE 1=1 "; /* O "WHERE 1=1" é um truque para facilitar a adição de condições com AND depois */
  

/* Filtros se não estiverem vazios */
if (!empty($nome)) {
    $nome_limpo = mysqli_real_escape_string($conn, $nome);
    $sql .= " AND u.nome LIKE '%$nome_limpo%'";
}

if (!empty($bimestre)) {
    $bim_limpo = mysqli_real_escape_string($conn, $bimestre);
    $sql .= " AND n.bimestre LIKE '%$bim_limpo%'";
}




$resultado = mysqli_query($conn, $sql);
?>

<!-- 3. Exibe os resultados em uma tabela -->
<!DOCTYPE html>
<html>
<head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Resultados da Busca</title>
    <!-- Inclua o CSS do Bootstrap aqui -->
</head>
<body>
<div class="container">
    <h2>Resultados da Pesquisa</h2>
    <a href="notas_form.php" class="btn btn-secondary mb-3">Voltar para a lista completa</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Bimestre</th>
                <th>Faltas</th>
                <th>Notas</th>
                <th>Média</th>
                <th>Situação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($resultado) > 0) {
                while ($linha = mysqli_fetch_assoc($resultado)) {
            $soma = $linha['nota1'] + $linha['nota2'] + $linha['nota3'];
                $media = $soma / 3;
                $ponderada = $media * $linha['peso'];
                
                // Lógica para definir a situação do aluno
                if ($media >= 7 && $linha['faltas'] <= 10) {
                    $situacao = "Aprovado";
                    $classe = "badge bg-success";
                } elseif ($media >= 5 && $linha['faltas'] <= 10) {
                    $situacao = "Recuperação";
                    $classe = "badge bg-warning text-dark";
                } else {
                    $situacao = "Reprovado";
                    $classe = "badge bg-danger";
                }
                    echo "<tr>";
                    echo "<td>" . $linha['nome'] . "</td>";
                    echo "<td>" . $linha['bimestre'] . "</td>";
                    echo "<td>" . $linha['faltas'] . "</td>";
                    echo "<td>" . $linha['nota1'] . " / " . $linha['nota2'] . " / " . $linha['nota3'] . "</td>";
                    echo "<td>" . number_format($media, 1, ',', '.') . "</td>";
                    echo "<td><span class='" . $classe . "'>" . $situacao . "</span></td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum aluno encontrado com esses filtros.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
