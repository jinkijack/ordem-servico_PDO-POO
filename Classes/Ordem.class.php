<?php
    require_once("Conexao.class.php");

    class Ordem{
        private $con;
        private $codigo;
        private $cod_tercerizado;
        private $cod_cliente;
        private $cod_servico;
        private $data_servico;
        private $status;
        private $data;

        public function __construct(){
            $this->con = new Conexao();
        }

        public function consultaStatusUsuario($status){
            try {
                $this->status = $status;
                
                $query = $this->con->conectar()->prepare("SELECT count(*) AS total
                FROM ordem WHERE status = ?");
                $query->bindParam(1,$this->status);
                $query->execute();
                $total = $query->fetchAll(PDO::FETCH_ASSOC);
                return $total;

            } catch (PDOException $ex) {
                return 'error'.$ex->getMessage();
            }
        }
        
    }
?>