<?php
session_start();
require_once ("../Classes/Generica.class.php");

if ((empty($_POST['email'])) OR (empty($_POST['senha'])) OR (empty($_POST['perfil']))){
    header("Location: ../index.php"); 
}
else{

	$email = $_POST["email"];
	$senha = $_POST["senha"];
	$perfil = $_POST["perfil"];

	if ($perfil == 1) {
		$objUsu = new Generica();
		$tabela= "usuario";
		$dados = $objUsu->checaLogin($tabela,$email,$senha);
	}elseif($perfil == 2){
		$objCli = new Generica();
		$tabela= "cliente";
		$dados = $objCli->checaLogin($tabela,$email,$senha);
	}else{
		$objTer = new Generica();
		$tabela= "terceirizado";
		$dados = $objTer->checaLogin($tabela,$email,$senha);
	}

	if($dados == "") {
		$_SESSION['texto_erro_login'] = 'Email, Senha ou Perfil Inválido!';
	    header("Location:../index.php");
	}
	elseif($dados['status'] != 1){
		$_SESSION['texto_erro_login'] = 'Acesso bloqueado ao sistema!';
	    header("Location:../index.php");	
	}
	else {
	    // Salva os dados encontrados na sessão
	    $_SESSION['cod_usu'] = $dados['cod'];
		$_SESSION['nome_usu'] = $dados['nome'];
		$_SESSION['perfil'] = $dados['perfil'];
		$_SESSION['status'] = $dados['status'];
	    header("Location:../home/home.php");
	}
	die();
}

?>