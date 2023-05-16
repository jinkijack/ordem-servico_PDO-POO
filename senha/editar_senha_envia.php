<?php
require_once("../valida_session/valida_session.php");
require_once ("../Classes/Generica.class.php");
	     
$codigo = $_SESSION['cod_usu'];
$senha = md5($_POST["senha"]);

if ($_SESSION['perfil'] == 1) {
	$tabela = "usuario";
	$objUsu = new Generica();
	$dados = $objUsu->editarSenha($tabela,$codigo,$senha);
}elseif($_SESSION['perfil'] == 2){
	$tabela = "cliente";
	$objCli = new Generica();
	$dados = $objCli->editarSenha($tabela,$codigo,$senha);
}else{
	$tabela = "terceirizado";
	$objTer = new Generica();
	$dados = $objCTer->editarSenha($tabela,$codigo,$senha);
}

if ($dados == 1){
	$_SESSION['texto_sucesso'] = 'A senha foi alterada no sistema.';
	header ("Location:editar_senha.php");
}else{
	$_SESSION['texto_erro'] = 'A senha não foi alterada no sistema!';
	header ("Location:editar_senha.php");
}		
?>