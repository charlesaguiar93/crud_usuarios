<?php
//--------
//ARQUIVO: includes/header.php
//Responsabilidade
//iniciar a estrutua html padrão ( head, navbar e abertura do main)
//todas as paginas incluem este arquivo para reaproveitar layout

//
if(!isset($pageTitle)) {
    $pageTitle = 'CRUD de Usuarios';
   
}

if(!isset($pageTitle)) {
   $pageTitle = 'CRUD de Notas'; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <!-- Bootstrap Icons -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <a href="notas_form.php" class="btn btn-primary mb-3">Cadastrar Nota</a>

</head>
<body>
    <div class="container">

    

