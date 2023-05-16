<?php
require_once("Conexao.class.php");

class Generica
{
    private $con;

    public function __construct()
    {
        $this->con = new Conexao();
    }

    public function checaLogin($tabela, $email, $senha)
    {
        try {

            $senhamd5 = md5($senha);

            $query = $this->con->conectar()->prepare("SELECT * FROM $tabela WHERE email = ? AND senha = ?");
            $query->bindParam(1, $email);
            $query->bindParam(2, $senhamd5);
            $query->execute();
            $retorno = $query->fetch(PDO::FETCH_ASSOC);

            return $retorno;
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function buscaDadoseditarPerfil($tabela, $codigo)
    {
        try {

            $query = $this->con->conectar()->prepare("SELECT * FROM $tabela
                            WHERE cod = ?");

            $query->bindParam(1, $codigo);
            $query->execute();
            $lista = $query->fetch(PDO::FETCH_ASSOC);

            return $lista;
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function editarSenha($tabela, $codigo, $senha)
    {
        try {
            $query = $this->con->conectar()->prepare("SELECT * FROM $tabela WHERE cod = ?");
            $query->bindParam(1, $codigo);
            $query->execute();
            $retorno = $query->fetch(PDO::FETCH_ASSOC);
            if (count($retorno) > 0) {
                $query = $this->con->conectar()->prepare("UPDATE $tabela SET senha = ? WHERE cod = ?");
                $query->bindParam(1, $senha);
                $query->bindParam(2, $codigo);
                $retorno = $query->execute(); //retorno boolean padrao TRUE
                if ($retorno) {
                    return 1;
                } else {
                    return 0;
                }
            }
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    public function consultaEmail($tabela,$email){
        try {
            $query = $this->con->conectar()->prepare("SELECT * FROM $tabela
                        WHERE email = ?");
        
            $query->bindParam(1,$email);
            $query->execute();
            $retorno = $query->fetch(PDO::FETCH_ASSOC);
            if ($retorno) {
                return 1;
            }else{
                return 0;
            }   
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }
    function queryRemover($tabela,$codigo){
        try{
            $query = $this->con->conectar()->prepare("DELETE FROM $tabela
                        WHERE cod = ?");
        
            $query->bindParam(1,$codigo);
            $query->execute();
            $retorno = $query->execute();
            if ($retorno) {
                return 1;
            }else{
                return 0;
            }   
        }catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

    function queryEditarInfo($tabela,$codigo,$status,$data){
        try{

            $query =  $this->con->conectar()->prepare("SELECT * FROM $tabela WHERE cod = ?");
            $query->bindParam(1,$codigo);
            $query->execute();
            $retorno = $query->fetch(PDO::FETCH_ASSOC);
        
            if(count($retorno) > 0){
                $query =  $this->con->conectar()->prepare("UPDATE $tabela SET status = ?, data = ? WHERE cod = ?");
                $query->bindParam(1, $status);
                $query->bindParam(2, $data);
                $query->bindParam(3, $codigo);
                $retorno = $query->execute();//retorno boolean padrao TRUE
                if($retorno){
                    return 1;
                } else{
                    return 0;
                }      
            }
        }catch(PDOException $ex){
            return 'error' . $ex->getMessage();
        }
    }

    function queryListaDados($tabela){
        try{
            $query = $this->con->conectar()->prepare("SELECT * FROM $tabela
                        ORDER BY nome");

            $query->execute();
            $lista = $query->fetchAll(PDO::FETCH_ASSOC);
            return $lista;
            
        }catch(PDOException $ex){
            return 'error' . $ex->getMessage();
        }
    }
    
}
