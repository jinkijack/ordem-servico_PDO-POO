<?php
session_start();
$nome = $_POST["nome"];
$senha = md5($_POST["senha"]);
$email = $_POST["email"];
$perfil = 1;
$status = $_POST["status"];
$data=date("y/m/d");

require_once ("../Classes/Generica.class.php");
require_once ("../Classes/Usuario.class.php");

$objUsu = new Generica();
$tabela = "usuario";
$dados = $objUsu->consultaEmail($tabela,$email);

if($dados != 0){
	$_SESSION['texto_erro'] = 'Este email já existe cadastrado no sistema!';
	$_SESSION['nome'] = $nome;
	$_SESSION['email'] = $email;
	header ("Location:cad_usuario.php");
}else{
	$objUsu = new Usuario();
	$dados = $objUsu->cadastraUsuario($nome,$senha,$email,$perfil,$status,$data);
	if($dados == 1){
		$_SESSION['texto_sucesso'] = 'Dados adicionados com sucesso.';
		unset($_SESSION['texto_erro']);
		unset ($_SESSION['nome']);
		unset ($_SESSION['email']);
		unset ($_SESSION['senha']);
		header ("Location:usuario.php");
	}else{
		$_SESSION['texto_erro'] = 'O dados não foram adicionados no sistema!';
		$_SESSION['nome_usu'] = $nome;
		$_SESSION['email'] = $email;
		header ("Location:cad_usuario.php");
	}
	
}

?>