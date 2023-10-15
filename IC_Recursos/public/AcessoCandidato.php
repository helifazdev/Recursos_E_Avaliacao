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
            <?php foreach($candidatos as $indice => $candidato) { ?>
            <b>Nome:</b> <?=$candidato->nome ?>
            <br>
            <b>N° de inscrição: </b> <?=$candidato->insc ?></i>
            <div><br>
            <?php } ?>
            <input type="hidden" name="Id_candidato" value="<?= $candidato->insc ?>">
            <b>Motivo:</b> <input type="text" name="Motivo" size="60" 
            placeholder="Digite o motivo do seu pedido" required/>
            <div><br>
            <b>Recurso:</b> <br> <textarea style="resize: none" type="text" name="Recurso"
             rows="6" cols="80" maxlength="500" placeholder="Escreva em no máximo 500 caracteres,
              um resumo do seu pedido de recurso, se necessario anexe a abaixo uma 
              documentação referente" required></textarea>
            <div><br>
            <b>Anexo:</b>
            <p>Se necessário inclua um arquivo para complementar seu recurso</p>
            <input type="file" name="arquivo" ></label>
            <div><br>
            <button type="submit">Enviar</button>
        </fieldset>
    </form>
</div>

</body>

<!-- Desenvolvido Por Helifaz Rocha -->

</html>