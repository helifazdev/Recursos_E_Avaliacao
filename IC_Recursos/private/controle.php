<?php

require "../../IC_Recursos/conexao.php";
require "../../IC_Recursos/recurso.modelo.php";
require "../../IC_Recursos/recurso.service.php";
require "../../IC_Recursos/candidato.modelo.php";
require "../../IC_Recursos/candidato.service.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;
//Login
if ($acao == 'Login') { // candidato
    $candidato = new Candidato();

    $candidato->__set('insc', $_POST['insc']);
    $candidato->__set('cpf', $_POST['cpf']);
    $conexao = new Conexao();

    $candidatoservice = new CandidatoService($conexao, $candidato);
    $log = $candidatoservice->Login();
    session_start();
    $insc = $_POST['insc'];
    $cpf = $_POST['cpf'];
    if (isset($_POST['submit'])) {
        if ($log < 1) {
            unset($_SESSION['insc']);
            unset($_SESSION['cpf']);
            header('Location: index.php');
        } else {
            // Verifique se o candidato já possui um recurso na tabela tb_recursos
            $recursoService = new RecursoService(new Conexao(), new Recurso());
            if ($recursoService->candidatoPossuiRecurso($insc)) {
                // O candidato já possui um recurso, redirecione para a tela "Concluído"
                header('Location: ConfereRecurso.php');
            } else {
                $_SESSION['insc'] = $insc;
                $_SESSION['cpf'] = $cpf;
                header('Location: AcessoCandidato.php?Sucesso');
            }
        }
    } else {
        $val = $candidatoservice->validacao();
        if ($val > 0) {
            header('Location: Concluido.php?ok');
        } else {
            header('Location: AcessoCandidato.php?ok');
        }
    }
} //Inserir
else if ($acao == 'inserir') { // recurso
    $recurso = new Recurso();
    session_start();
    $nomedoarquivo = $_FILES['arquivo']['name'];
    $extensao = pathinfo($nomedoarquivo, PATHINFO_EXTENSION); // Extensão do arquivo
    $aleatorio = uniqid(); // chave aleatória única
    $caminhoatualdoarquivo = $_FILES['arquivo']['tmp_name'];
    $caminhosalvar = 'arquivos/' . $_SESSION['insc'] . "_IC_Recursos_" . $aleatorio . "." . $extensao;

    move_uploaded_file($caminhoatualdoarquivo, $caminhosalvar);
    $recurso->__set('Motivo', $_POST['Motivo']);
    $recurso->__set('Recurso', $_POST['Recurso']);
    $recurso->__set('Id_candidato', $_POST['Id_candidato']);
    $recurso->__set(':arquivo', $nomeArquivo);
    $recurso->__set('arquivo', $_FILES['arquivo']);
    $conexao = new Conexao();
    $recursoservice = new RecursoService($conexao, $recurso);
    $recursoservice->inserir();
} else if ($acao == 'recuperar') {
    $candidato = new Candidato();
    $conexao = new Conexao();
    $recurso = new recurso();

    $candidatoservice = new CandidatoService($conexao, $candidato);
    $recursoservice = new RecursoService($conexao, $recurso);
    
    $candidatos = $candidatoservice->recuperar();
    $recursos = $recursoservice->recuperar();
}

// Desenvolvido Por Helifaz Rocha 
