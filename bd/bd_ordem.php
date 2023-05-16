<?php 

require_once("conecta_bd.php");

function consultaStatusUsuario($status){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT count(*) AS total
                FROM ordem WHERE status = ?");

    $query->bindParam(1,$status);
    $query->execute();
    $total = $query->fetchAll(PDO::FETCH_ASSOC);

    return $total;
}

function listaOrdem(){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT
                                    o.cod AS cod,
                                    c.nome AS nome_cliente,
                                    t.nome AS nome_terceirizada,
                                    s.nome AS nome_servico,
                                    o.data_servico AS data_servico,
                                    o.status AS status
                                FROM  
                                    ordem o,servico s, cliente c, 
                                    terceirizado t
                                where 
                                    o.cod_cliente = c.cod AND
                                    o.cod_servico = s.cod AND
                                    o.cod_terceirizado = t.cod");

    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}

function cadastraOrdem($cod_cliente,$cod_servico,$cod_terceirizado,$data_servico,$status,$data){
    $conexao = conecta_bd();

    $query = $conexao->prepare("INSERT INTO ordem(cod_cliente,cod_servico,cod_terceirizado,
            data_servico,status,data) VALUES (?,?,?,?,?,?)");

    $query->bindParam(1,$cod_cliente);
    $query->bindParam(2,$cod_servico);
    $query->bindParam(3,$cod_terceirizado);
    $query->bindParam(4,$data_servico);
    $query->bindParam(5,$status);
    $query->bindParam(6,$data);

    $retorno = $query->execute();
    if($retorno){
        return 1;
    } else{
        return 0;
    }        
}


function buscaOrdemadd (){
    $conexao = conecta_bd();

    $query = $conexao->prepare("Select 
                                    c.nome AS nome_cliente,
                                    t.nome AS nome_terceirizada,
                                    s.nome AS nome_servico,
                                    s.valor AS valor_servico,
                                    o.data_servico AS data_servico,
                                    o.status AS status
                                From 
                                    ordem o,servico s, cliente c,
                                        terceirizado t 
                                Where 
                                    o.cod_cliente = c.cod AND 
                                    o.cod_servico = s.cod AND 
                                    o.cod_terceirizado = t.cod
                                ORDER BY o.cod DESC LIMIT 1");
    $query->execute();
    $lista = $query->fetch(PDO::FETCH_ASSOC);
    return $lista;
}

function buscaOrdemeditar($codigo){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT 
                                    o.cod AS cod,
                                    c.nome AS nome_cliente,
                                    t.nome AS nome_terceirizada,
                                    s.nome AS nome_servico,
                                    o.data_servico AS data_servico,
                                    o.status AS status,
                                    t.cod AS cod_terceirizado
                                FROM 
                                    ordem o,
                                    servico s,
                                    cliente c,
                                    terceirizado t 
                                WHERE 
                                    o.cod_cliente = c.cod AND 
                                    o.cod_servico = s.cod AND 
                                    o.cod_terceirizado = t.cod AND 
                                    o.cod = :codigo");
    $query->bindParam(":codigo", $codigo);
    $query->execute();
    $dados = $query->fetch(PDO::FETCH_ASSOC);

    return $dados;
}

function listaOrdemCliente(){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT
                                    o.cod AS cod,
                                    c.nome AS nome_cliente,
                                    t.nome AS nome_terceirizada,
                                    s.nome AS nome_servico,
                                    o.data_servico AS data_servico,
                                    o.status AS status
                                FROM  
                                    ordem o,servico s, cliente c, 
                                    terceirizado t
                                where 
                                    o.cod_cliente = c.cod AND
                                    o.cod_servico = s.cod AND
                                    o.cod_terceirizado = t.cod AND
                                    o.cod_cliente = ?
                                ORDER by o.status ASC");
    
    $query->bindParam(1, $_SESSION['cod_usu']);
    
    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}

function listaOrdemTerceirizado(){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT
                                    o.cod AS cod,
                                    c.nome AS nome_cliente,
                                    t.nome AS nome_terceirizada,
                                    s.nome AS nome_servico,
                                    o.data_servico AS data_servico,
                                    o.status AS status
                                FROM  
                                    ordem o,servico s, cliente c, 
                                    terceirizado t
                                where 
                                    o.cod_cliente = c.cod AND
                                    o.cod_servico = s.cod AND
                                    o.cod_terceirizado = t.cod AND
                                    o.cod_terceirizado = ?
                                ORDER by o.status ASC");
    
    $query->bindParam(1, $_SESSION['cod_usu']);
    
    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}

function editarOrdem($codigo,$cod_terceirizado,$data_servico,$status,$data){
    $conexao = conecta_bd();

    $query = $conexao->prepare("SELECT * FROM ordem WHERE cod = ?");
    $query->bindParam(1,$codigo);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);

    if(count($retorno) > 0){
        $query = $conexao->prepare("UPDATE ordem SET cod_terceirizado = ?, data_servico = ?, status = ?, data = ? WHERE cod = ?");
        $query->bindParam(1, $cod_terceirizado);
        $query->bindParam(2, $data_servico);
        $query->bindParam(3, $status);
        $query->bindParam(4, $data);
        $query->bindParam(5, $codigo);
        $retorno = $query->execute();//retorno boolean padrao TRUE
        if($retorno){
            return 1;
        } else{
            return 0;
        }      
    }
}
?>