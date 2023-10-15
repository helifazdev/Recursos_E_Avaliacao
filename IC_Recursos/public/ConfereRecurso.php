<?php
$acao = 'recuperar';
require 'redirecionar.php';


if(!isset($_SESSION)){
    session_start();
        if((!isset($_SESSION['insc']) == true) and (!isset($_SESSION['cpf']) == true))
    {
            unset($_SESSION['insc']);
            unset($_SESSION['cpf']);
            header('Location: index.php?redirect');
        }
            $logado = $_SESSION['insc']; 

    
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <!-- Icone e título-->
    <title>Recursos - IC</title>
    <link rel="icon" href="img/Logos/IconeIAUPE.png">
    <!-- CSS -->
    <link rel="stylesheet" href="Css/normalize.css">
    <link rel="stylesheet" href="Css/main.css">
    <!-- JS -->
    <script defer src="js/main.js"></script>
</head>

<body>
    <div class="Titulo1">
        <h1>Formulario de Recursos do IAUPE Concursos</h1>
    </div>

 
<!-- Fomrmulário de Acesso -->
<div class="box">
    <form method="post" enctype="multipart/form-data" 
    action="redirecionar.php?acao=inserir">
        <fieldset>
            <legend><b>Recurso</b></legend>
            <img src="img/Logos/Logo Concursos .png">
            <div><br>
            <?php foreach($candidatos as $indice => $candidato)  { ?>
            <b>Nome: <?=$candidato->nome ?></b>
            <br>
            <b>N° de inscrição:  <?=$candidato->insc ?></b>
            <div><br>
            <?php } ?>
            <?php foreach($recursos as $indice => $recurso)  { ?>
            <b>Motivo:</b> <i><?=$recurso->motivo ?></i>
            <div><br>
            <b>Recurso:</b> <i><?=$recurso->recurso ?></i>
            <div><br>
            <b>Anexo:</b> <i> Você nos enviou o arquivo: <b><?=$recurso->arquivo?></b></i> <br>
            <i>Com o registro: </i> <b><?=$recurso->data_hora_recurso?></b> <i>, e está sendo analisado!</i>
            <?php } ?>
            <div><br>
        </fieldset>
    </form>
</div>

</body>

<!-- Desenvolvido Por Helifaz Rocha -->

</html>