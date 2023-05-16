<?php
    require_once("Conexao.class.php");

    class Clientes{
        private $con;
        private $nome;
        private $codigo;
        private $senha;
        private $email;
        private $endereco;
        private $numero;
        private $bairro;
        private $cidade;
        private $telefone;
        private $data;
        private $status;
        private $perfil;
        private $cod_usuario;

        public function __construct(){
            $this->con = new Conexao();
        }

        public function editarPerfilCliente($codigo,$nome,$email,$endereco,$numero,$bairro,$cidade,$telefone,$data){
            try {

                $this->codigo = $codigo;
                $this->nome = $nome;
                $this->email = $email;
                $this->endereco = $endereco;
                $this->numero = $numero;
                $this->bairro = $bairro;
                $this->cidade = $cidade;
                $this->telefone = $telefone;
                $this->data = $data;

                $query = $this->con->conectar()->prepare("SELECT * FROM cliente WHERE cod = ?");
                $query->bindParam(1,$codigo);
                $query->execute();
                $retorno = $query->fetch(PDO::FETCH_ASSOC);
                if(count($retorno) > 0){
                    $query = $this->con->conectar()->prepare("UPDATE cliente SET nome = ?, email = ?,endereco = ?,numero =?, bairro = ?,cidade = ?, telefone = ?, data = ? WHERE cod = ?");
                    $query->bindParam(1, $this->nome);
                    $query->bindParam(2, $this->email);
                    $query->bindParam(3, $this->endereco);
                    $query->bindParam(4, $this->numero);
                    $query->bindParam(5, $this->bairro);
                    $query->bindParam(6, $this->cidade);
                    $query->bindParam(7, $this->telefone);
                    $query->bindParam(8, $this->data);
                    $query->bindParam(9, $this->codigo);
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

        public function queryInserir($nome,$email,$senha,$endereco,$numero,$bairro,$cidade,$telefone,$status,$perfil,$data){
           try {
            
                $this->nome = $nome;
                $this->email = $email;
                $this->senha = $senha;
                $this->endereco = $endereco;
                $this->numero = $numero;
                $this->bairro = $bairro;
                $this->cidade = $cidade;
                $this->telefone = $telefone;
                $this->status = $status;
                $this->perfil = $perfil;
                $this->data = $data;

                $query =$this->con->conectar()->prepare("INSERT INTO cliente(nome,email,senha,endereco,numero,bairro,
                cidade,telefone,status,perfil,data) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

                $query->bindParam(1,$this->nome);
                $query->bindParam(2,$this->email);
                $query->bindParam(3,$this->senha);
                $query->bindParam(4,$this->endereco);
                $query->bindParam(5,$this->numero);
                $query->bindParam(6,$this->bairro);
                $query->bindParam(7,$this->cidade);
                $query->bindParam(8,$this->telefone);
                $query->bindParam(9,$this->status);
                $query->bindParam(10,$this->perfil);
                $query->bindParam(11,$this->data);
                $retorno = $query->execute();
                if($retorno){
                    return 1;
                } else{
                    return 0;
                }  
           } catch (PDOException $ex){
            return 'error'.$ex->getMessage(); 
           }      
        }

        public function consultaStatusCliente($tabela,$cod_usuario,$status){
            try {
                $this->status = $status;
                $this->cod_usuario = $cod_usuario;
                $query = $this->con->conectar()->prepare("SELECT count(*) AS total
                            FROM $tabela
                            WHERE cod_cliente = ? AND status = ?");
            
                $query->bindParam(1,$this->cod_usuario);
                $query->bindParam(2,$this->status);
                $query->execute();
                $total = $query->fetchAll(PDO::FETCH_ASSOC);
            
                return $total;
               
            } catch (PDOException $ex) {
                return 'error' . $ex->getMessage();
            }
        }
    }
?>