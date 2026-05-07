


<?php
// 1. Conexão com o banco de dados
$host = "localhost";
$user = "root";
$pass = "";
$db   = "crud_smpls";

$conn = new mysqli($host, $user, $pass, $db);

// 2. Busca os usuários para o Select
$sql_usuarios = "SELECT id, nome FROM usuarios ORDER BY nome ASC";
$result_usuarios = $conn->query($sql_usuarios);
?>
<a href="form.php" class="btn btn-secondary">Adicionar Aluno</a>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Notas</title>
    <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Lançar Notas dos Alunos</h3>
        </div>
        <div class="card-body">

     
            <form action="notas_salvar.php" method="POST">
                
                <!-- Seleção de Aluno -->
                <div class="mb-3">
                    <label class="form-label">Aluno:</label>
                    <select name="aluno_id" class="form-select" required>
                        <option value="">Selecione o aluno...</option>
                        <?php while($row = $result_usuarios->fetch_assoc()): ?>
                            <option value="<?= $row['id'] ?>"><?= $row['nome'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="row">
                    <!-- Bimestre -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Bimestre:</label>
                        <select name="bimestre" class="form-select" required>
                            <option value="1º Bimestre">1º Bimestre</option>
                            <option value="2º Bimestre">2º Bimestre</option>
                            <option value="3º Bimestre">3º Bimestre</option>
                            <option value="4º Bimestre">4º Bimestre</option>
                        </select>
                    </div>

                    <!-- Faltas -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Faltas:</label>
                        <input type="number" name="faltas" class="form-control" value="0" min="0">
                    </div>
                </div>

                <div class="row">
                    <!-- Notas -->
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Nota 1:</label>
                        <input type="number" name="nota1" class="form-control" step="0.01" min="0" max="10" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Nota 2:</label>
                        <input type="number" name="nota2" class="form-control" step="0.01" min="0" max="10" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Nota 3:</label>
                        <input type="number" name="nota3" class="form-control" step="0.01" min="0" max="10" required>
                    </div>
                    <!-- Peso -->
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Peso:</label>
                        <input type="number" name="peso" class="form-control" step="0.01" value="1.00">
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Salvar Notas</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                     
                </div>
            </form>
   
        </div>
    </div>
</div>

</body>
</html>
