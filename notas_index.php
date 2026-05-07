<?php
require_once 'conexao.php';


include 'includes/header.php'; // Inclui o header com o layout e navbar


// Busca os resumos para os cards.
$sqlResumo = "SELECT 
                COUNT(*) as total_lancamentos, 
                MAX((nota1+nota2+nota3)/3) as maior_media, 
                MIN((nota1+nota2+nota3)/3) as menor_media, 
                AVG((nota1+nota2+nota3)/3) as media_geral 
              FROM notas_alunos";
$res_resumo = mysqli_query($conn, $sqlResumo);
$resumo = mysqli_fetch_assoc($res_resumo);


// Busca a lista para a tabela de notas.
$sql = "SELECT n.id, u.nome, n.bimestre, n.nota1, n.nota2, n.nota3, n.peso, n.faltas
        FROM notas_alunos n 
        INNER JOIN usuarios u ON n.aluno_id = u.id";
$res_lista = mysqli_query($conn, $sql);
// O fetch_all pega todas as linhas de uma vez
$relatorio = mysqli_fetch_all($res_lista, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Notas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2 class="mb-4">Relatório de Notas e Situação</h2>

   
    <h2 class="mb-4">Relatório de Notas</h2>

   
    <div class="row mb-4">
    <!-- Total de Lançamentos -->
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Lançamentos</h5>
                <p class="card-text fs-3"><?= $resumo['total_lancamentos'] ?></p>
            </div>
        </div>
    </div>

    <!-- Maior Média -->
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Maior Média</h5>
                <p class="card-text fs-3"><?= number_format($resumo['maior_media'], 1, ',', '.') ?></p>
            </div>
        </div>
    </div>

    <!-- Menor Média -->
    <div class="col-md-3">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <h5 class="card-title">Menor Média</h5>
                <p class="card-text fs-3"><?= number_format($resumo['menor_media'], 1, ',', '.') ?></p>
            </div>
        </div>
    </div>

    <!-- Média Geral -->
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Média Geral</h5>
                <p class="card-text fs-3"><?= number_format($resumo['media_geral'], 1, ',', '.') ?></p>
            </div>
        </div>
    </div>
</div>

<?= isset($_GET['msg']) && $_GET['msg'] === 'excluido' ? '<p class="text-success">Nota excluída com sucesso!</p>' : '' ?>
<?= isset($_GET['msg']) && $_GET['msg'] === 'atualizado' ? '<p class="text-success">Nota atualizada com sucesso!</p>' : ''?> 
    
<table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Aluno</th>
                <th>Bimestre</th>
                <th>N1</th>
                <th>N2</th>
                <th>N3</th>
                <th>Soma</th>
                <th>Média</th>
                <th>M. Ponderada</th>
                <th>Faltas</th>
                <th>Situação</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($relatorio as $linha): 
                // Cálculos em tempo de execução
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
            ?>
            
            <tr>
                <!--, 1, ',', '.' Apareçam como 8,5 em vez de 8.5000. number_format  defi-->
                <td><?= $linha['nome'] ?></td>
                <td><?= $linha['bimestre'] ?></td>
                <td><?= number_format($linha['nota1'], 1, ',', '.') ?></td>
                <td><?= number_format($linha['nota2'], 1, ',', '.') ?></td>
                <td><?= number_format($linha['nota3'], 1, ',', '.') ?></td>
                <td><?= number_format($soma, 1, ',', '.') ?></td>
                <td><?= number_format($media, 1, ',', '.') ?></td>
                <td><?= number_format($ponderada, 1, ',', '.') ?></td>
                <td><?= $linha['faltas'] ?></td>
                <td><span class="<?= $classe ?>"><?= $situacao ?></span></td>
                <td class="text-center">
                   <!-- envia o ID da nota para a página de edição -->
                <a href='notas_editar.php?id=<?= $linha['id'] ?>'><i class='bi bi-pencil'></i></a> |
                    <a href='notas_excluir.php?id=<?= $linha['id'] ?>' onclick="return confirm('Tem certeza que deseja excluir?')">
                        <i class='bi bi-trash3'></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
