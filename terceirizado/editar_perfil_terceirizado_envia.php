<?php
require_once("../valida_session/valida_session.php");
require_once ("../Classes/Terceirizado.class.php");
         
$codigo = $_POST["cod"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$data=date("y/m/d");
$objCli = new Tercerizado();

$dados = $objCli->editarPerfilTerceirizado($codigo,$nome,$email,$telefone,$data);
if ($dados == 1){
    $_SESSION['nome_usu'] = $nome;
    $_SESSION['texto_sucesso'] = 'Os dados do terceirizado foram alterados no sistema.';
    header ("Location:editar_perfil_terceirizado.php");
}else{
    $_SESSION['texto_erro'] = 'Os dados do terceirizado não foram alterados no sistema!';
    header ("Location:editar_perfil_terceirizado.php");
}
       
?>