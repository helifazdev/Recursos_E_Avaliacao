<?php
//CRUD
class RecursoService {

	private $conexao;
	private $recurso;

	public function __construct(Conexao $conexao, Recurso $recurso) {
		$this->conexao = $conexao->conectar();
		$this->recurso = $recurso;
	}

	public function inserir() {
		session_start();
		$id_candidato = $_SESSION['insc'];
	
		// Verifique se o candidato já possui um recurso na tabela tb_recursos
		$query = "SELECT COUNT(*) FROM tb_recursos WHERE id_candidato = :id_candidato";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindParam(':id_candidato', $id_candidato);
		$stmt->execute();
		$count = $stmt->fetchColumn();
	
		if ($count > 0) {
			header('Location: Concluido.php?EmAnalise');
		} else {
			// Continue com a inserção do recurso
			$nomeArquivo = $_FILES['arquivo']['name'];

			$query = 'INSERT INTO tb_recursos (id_candidato, Motivo, Recurso, arquivo) VALUES (:id_candidato, :Motivo, :Recurso, :arquivo)';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindParam(':id_candidato', $id_candidato);
			$stmt->bindValue(':Motivo', $this->recurso->__get('Motivo'));
			$stmt->bindValue(':Recurso', $this->recurso->__get('Recurso'));
			$stmt->bindParam(':arquivo', $nomeArquivo);
			$stmt->execute();
	
			header('Location: Concluido.php?Concluido=1');
		}
	}

	// Função para verificar se o candidato já possui um recurso
	public function candidatoPossuiRecurso($id_candidato) {
		$query = "SELECT COUNT(*) FROM tb_recursos WHERE id_candidato = :id_candidato";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindParam(':id_candidato', $id_candidato);
		$stmt->execute();
		$count = $stmt->fetchColumn();
		return $count > 0;
	}
	

	public function recuperar() { //read
		if(!isset($_SESSION)) 
		{ 
			session_start(); 
		} 
		$insc = $_SESSION['insc'];
		$query = "SELECT * FROM tb_recursos WHERE id_candidato = $insc	";
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function atualizar() { //update

	}

	public function remover() { //delete

	}
}

// Desenvolvido Por Helifaz Rocha 

?>