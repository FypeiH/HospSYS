<?php 

require_once("../../conexao.php");

@session_start();


$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];
$data_entrada = $_POST['data_entrada'];
$password = $_POST['password'];
@$confirmar_password = $_POST['confirmar_password'];
@$foto = $_POST['foto'];
$campo_antigo = $_POST['campo_antigo'];
$password_antiga = $_POST['password_antiga'];



@$id = $_SESSION['id_utilizador'];
@$nivel = $_SESSION['nivel_utilizador'];

//Pesquisar os dados do registo a ser editado

$resultado = $pdo->query("SELECT * from utilizadores where id = '$id'");

$dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

$foto_original = $dados[0]['foto'];
$cc = $dados[0]['cc'];
$nif = $dados[0]['nif'];



//Script para as fotos na base de dados

$caminho = '../../img/fotos-perfil/' .$_FILES['foto']['name'];

if ($_FILES['foto']['name'] == ""){
	$imagem = $foto_original;
}else{
	$imagem = $_FILES['foto']['name']; 
}

$imagem_temp = $_FILES['foto']['tmp_name']; 
move_uploaded_file($imagem_temp, $caminho);


//Buscar o id do cargo
$resultado_cargo = $pdo->query("SELECT * from cargos where nome = 'Admin' or nome = 'admin' or nome = 'Administrador' or nome = 'administrador'");
$dados_cargo = $resultado_cargo->fetchAll(PDO::FETCH_ASSOC);
$id_cargo = $dados_cargo[0]['id'];



if($password == "" && $confirmar_password == "")
{
	$resultado = $pdo->prepare("UPDATE utilizadores set nome = :nome, email = :email, nif = :nif, cc = :cc, telefone = :telefone, data_nascimento = :data_nascimento, data_entrada = :data_entrada, cedula = :cedula, especialidade = :especialidade, password = :password, nivel = :nivel, estado_conta = :estado_conta, foto = :foto where id = :id");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":email", $email);
	$resultado->bindValue(":nif", $nif);
	$resultado->bindValue(":cc", $cc);
	$resultado->bindValue(":telefone", $telefone);
	$resultado->bindValue(":data_nascimento", $data_nascimento);
	$resultado->bindValue(":data_entrada", $data_entrada);
	$resultado->bindValue(":especialidade", NULL);
	$resultado->bindValue(":cedula", NULL);
	$resultado->bindValue(":id", $id);
	$resultado->bindValue(":password", $password_antiga);
	$resultado->bindValue(":nivel", $nivel);
	$resultado->bindValue(":foto", $imagem);
	$resultado->bindValue(":estado_conta", 'Ativo');

	$resultado->execute();

	$resultado = $pdo->prepare("UPDATE funcionarios set nome = :nome, email = :email, nif = :nif, cc = :cc, telefone = :telefone, data_nascimento = :data_nascimento, data_entrada = :data_entrada, cargo = :cargo where nif = :nif_antigo");

$resultado->bindValue(":nome", $nome);
$resultado->bindValue(":nif", $nif);
$resultado->bindValue(":cc", $cc);
$resultado->bindValue(":data_nascimento", $data_nascimento);
$resultado->bindValue(":data_entrada", $data_entrada);
$resultado->bindValue(":telefone", $telefone);
$resultado->bindValue(":email", $email);
$resultado->bindValue(":cargo", $id_cargo);

$resultado->bindValue(":nif_antigo", $campo_antigo);

$resultado->execute();


	echo "<script language='javascript'>window.alert('Editado com Sucesso!'); </script>";
	echo "<script language='javascript'>window.location='../index.php?acao=editar-perfil'; </script>";
}
if($password == $confirmar_password && strlen($password)>=8)
{
	$resultado = $pdo->prepare("UPDATE utilizadores set nome = :nome, email = :email, nif = :nif, cc = :cc, telefone = :telefone, data_nascimento = :data_nascimento, data_entrada = :data_entrada, cedula = :cedula, especialidade = :especialidade, password = :password, nivel = :nivel, estado_conta = :estado_conta, foto = :foto where id = :id");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":especialidade", NULL);
	$resultado->bindValue(":cedula", NULL);
	$resultado->bindValue(":nif", $nif);
	$resultado->bindValue(":cc", $cc);
	$resultado->bindValue(":data_nascimento", $data_nascimento);
	$resultado->bindValue(":data_entrada", $data_entrada);
	$resultado->bindValue(":telefone", $telefone);
	$resultado->bindValue(":email", $email);
	$resultado->bindValue(":id", $id);
	$resultado->bindValue(":password",md5($password));
	$resultado->bindValue(":nivel", $nivel);
	$resultado->bindValue(":foto", $imagem);
	$resultado->bindValue(":estado_conta", 'Ativo');

	$resultado->execute();

	$resultado = $pdo->prepare("UPDATE funcionarios set nome = :nome, email = :email, nif = :nif, cc = :cc, telefone = :telefone, data_nascimento = :data_nascimento, data_entrada = :data_entrada, cargo = :cargo where nif = :nif_antigo");

$resultado->bindValue(":nome", $nome);
$resultado->bindValue(":nif", $nif);
$resultado->bindValue(":cc", $cc);
$resultado->bindValue(":data_nascimento", $data_nascimento);
$resultado->bindValue(":data_entrada", $data_entrada);
$resultado->bindValue(":telefone", $telefone);
$resultado->bindValue(":email", $email);
$resultado->bindValue(":cargo", $id_cargo);

$resultado->bindValue(":nif_antigo", $campo_antigo);

$resultado->execute();

	echo "<script language='javascript'>window.alert('Editado com Sucesso!'); </script>";
	echo "<script language='javascript'>window.location='../index.php?acao=editar-perfil'; </script>";
}


if($password != $confirmar_password)
{
	echo "<script language='javascript'>window.alert('As passwords n??o coincidem!'); </script>";
	echo "<script language='javascript'>window.location='../index.php?acao=editar-perfil'; </script>";
}
if(strlen($password)<8 && strlen($password)>1)
{
	echo "<script language='javascript'>window.alert('A password tem de ter mais de 8 caracteres!'); </script>";
	echo "<script language='javascript'>window.location='../index.php?acao=editar-perfil'; </script>";
}


?>