<?php
    
 class Conexao {
    private $host = 'localhost';
    private $dbname = 'ic_recursos';
    private $user = 'root';
    private $pass = '';


    public function conectar(){

        try {       $conexao = new PDO(
                    "mysql:host=$this->host;dbname=$this->dbname",
				    "$this->user",
				    "$this->pass"
                ) or print (mysql_error());;

                return $conexao;
           
               
           } catch (PDOException $e) {
               echo 'Erro: ' . $e->getCode() . ' Mensagem: ' . $e->getMessage();
               //registrar o erro de alguma forma.
           }

    }

 }

// Desenvolvido Por Helifaz Rocha 

?>