<?php
    require_once("Conexao.class.php");

    class Tercerizado{
        private $con;
        private $codigo;
        private $nome;
        private $email;
        private $data;
        private $telefone;
        private $status;
        private $cod_usuario;
        private $senha;
        private $perfil;

        public function __construct(){
            $this->con = new Conexao();
        }

        public function editarPerfilTerceirizado($codigo,$nome,$email,$telefone,$data){
            try {

                $this->codigo = $codigo;
                $this->nome = $nome;
                $this->email = $email;
                $this->telefone = $telefone;
                $this->data = $data;

                $query = $this->con->conectar()->prepare("SELECT * FROM terceirizado WHERE cod = ?");
                $query->bindParam(1,$codigo);
                $query->execute();
                $retorno = $query->fetch(PDO::FETCH_ASSOC);
                if(count($retorno) > 0){
                    $query = $this->con->conectar()->prepare("UPDATE terceirizado SET nome = ?, email = ?, telefone = ?, data = ? WHERE cod = ?");
                    $query->bindParam(1,$this->nome);
                    $query->bindParam(2,$this->email);
                    $query->bindParam(3,$this->telefone);
                    $query->bindParam(4,$this->data);
                    $query->bindParam(5,$this->codigo);
                    $retorno = $query->execute();//retorno boolean padrao TRUE
                    if($retorno){
                        return 1;
                    } else{
                        return 0;
                    }   
                }     
            } catch (PDOException $ex){
                return 'error'.$ex->getMessage(); 
            }
        }
        
        public function consultaStatusTercerizado($tabela,$cod_usuario,$status){
                try {
                    $this->status = $status;
                    $this->cod_usuario = $cod_usuario;
                    $query = $this->con->conectar()->prepare("SELECT count(*) AS total
                                    FROM $tabela
                                    WHERE cod_terceirizado = ? AND status = ?");
                
                    $query->bindParam(1,$this->cod_usuario);
                    $query->bindParam(2,$this->status);
                    $query->execute();
                    $total = $query->fetchAll(PDO::FETCH_ASSOC);
                
                    return $total;
                   
                } catch (PDOException $ex) {
                    return 'error' . $ex->getMessage();
                }
            }

        public function cadastraTerceirizado($nome,$email,$telefone,$senha,$status,$perfil,$data){
        
            $this->nome = $nome;
            $this->email = $email;
            $this->telefone = $telefone;
            $this->senha = $senha;
            $this->status = $status;
            $this->perfil = $perfil;
            $this->data = $data;

            $query = $this->con->conectar()->prepare("INSERT INTO terceirizado(nome,email,telefone,senha,
            status,perfil,data) VALUES (?,?,?,?,?,?,?)");
        
            $query->bindParam(1,$this->nome);
            $query->bindParam(2,$this->email);
            $query->bindParam(3,$this->telefone);
            $query->bindParam(4,$this->senha);
            $query->bindParam(5,$this->status);
            $query->bindParam(6,$this->perfil);
            $query->bindParam(7,$this->data);
            $retorno = $query->execute();
            if($retorno){
                return 1;
            } else{
                return 0;
            }        
        }
    }
?>