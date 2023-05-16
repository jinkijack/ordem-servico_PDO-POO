<?php

     class Conexao
     {
         
         private $usuario;
         private $senha;
         private $banco;
         private $servidor;
         private static $pdo;

         public function __construct()
         {
             $this->servidor = "localhost";
             $this->banco = "ordemservico";
             $this->usuario = "root";
             $this->senha = "";
         }

         public function conectar()
         {
             try{
                 //verifica se a classe foi instanciada
                 if(is_null(self::$pdo)){
                     self::$pdo = new PDO("mysql:host=".$this->servidor.";dbname=".$this->banco, $this->usuario,$this->senha);
                 }
                 return self::$pdo;

             }catch(PDOException $ex){
                 return 'error'.$ex->getMessage();
             }
         }
     }
?>