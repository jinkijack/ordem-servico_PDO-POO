<?php
require_once("../valida_session/valida_session.php");
require_once ("../bd/bd_terceirizado.php");
require_once ("../bd/bd_generico.php");
require_once("../Classes/Generica.class.php");

$codigo = $_POST["cod"];
$status = $_POST["status"];
$data=date("y/m/d");
$objCli = new Generica();
$tabela = 'terceirizado';
$dados = $objCli->queryEditarInfo($tabela,$codigo,$status,$data);


if ($dados == 1){
	$_SESSION['texto_sucesso'] = 'Os dados do terceirizado foram alterados no sistema.';
	header ("Location:terceirizado.php");
}else{
	$_SESSION['texto_erro'] = 'Os dados do terceirizado não foram alterados no sistema!';
	header ("Location:terceirizado.php");
}

?>