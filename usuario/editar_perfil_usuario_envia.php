<?php
require_once('../valida_session/valida_session.php');
require_once ("../Classes/Usuario.class.php");
         
$codigo = $_POST["cod"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$data=date("y/m/d");
$objUsu = new Usuario();

// $tabela = "usuario";
// $dados = editardados($codigo,$tabela,array(
//     "nome" => $nome,
//     "email" => $email,
//     "datacad" => $data
// ));

$dados = $objUsu->editarPerfilUsuario($codigo,$nome,$email,$data);
if ($dados == 1){
    $_SESSION['nome_usu'] = $nome;
    $_SESSION['texto_sucesso'] = 'Os dados do usuário foram alterados no sistema.';
    header ("Location:editar_perfil_usuario.php");
}else{
    $_SESSION['texto_erro'] = 'Os dados do usuário não foram alterados no sistema!';
    header ("Location:editar_perfil_usuario.php");
}

     
?>