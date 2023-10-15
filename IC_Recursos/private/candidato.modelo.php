<?php

class Candidato {
    private $id;
	private $nome;
    private $insc;
	private $cpf;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}
}

// Desenvolvido Por Helifaz Rocha 

?>