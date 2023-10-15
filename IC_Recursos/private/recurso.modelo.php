<?php

class Recurso {
    private $id_envio;
	private $id_status;
    private $motivo;
	private $recurso;
    private $arquivo;
	private $id_cand;
	private $id_candidato;
	private $enviou_recurso;

	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
	}
}

// Desenvolvido Por Helifaz Rocha 

?>