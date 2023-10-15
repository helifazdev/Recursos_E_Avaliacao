<?php

//CRUD
class CandidatoService {

	private $conexao;
	private $candidato;

	public function __construct(Conexao $conexao, Candidato $candidato) {
		$this->conexao = $conexao->conectar();
		$this->candidato = $candidato;
	}

	public function Login() { 
        $insc = $_POST['insc'];
        $cpf = $_POST['cpf'];
        $sql = "SELECT COUNT(*) FROM tb_candidato WHERE insc = $insc and cpf = $cpf";
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute();
		return $stmt->fetchColumn();
		
	}
	public function recuperar() { //read
		session_start();
		$insc = $_SESSION['insc'];
		$query = "SELECT * FROM tb_candidato WHERE insc = $insc	";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function validacao() {
		session_start();
		$insc = $_SESSION['insc'];
		$query = "SELECT COUNT(id_candidato) FROM tb_recursos WHERE id_cand = $insc";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchColumn();
		
	}

	public function atualizar() { //update

	}

	public function remover() { //delete

	}
}

// Desenvolvido Por Helifaz Rocha 

?>