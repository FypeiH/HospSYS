<?php 

require_once("../../conexao.php");


$nome = $_POST['nome'];
$nif = $_POST['nif'];
$cc = $_POST['cc'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];
$obs = $_POST['obs'];



//Verificar se o paciente existe

$resultado_verificar = $pdo->query("SELECT * from utilizadores where nif = '$nif'");

$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados_verificar);


if($nome == '')
{
	echo "Preencha o Campo!";
	exit();
}
if($nif == '')
{
	echo "Preencha o Campo!";
	exit();
}


if($linhas == 0)
{

	$resultado = $pdo->prepare("INSERT into utilizadores (nome, nif, cc, telefone, email, data_nascimento, password, obs, nivel) values (:nome, :nif, :cc, :telefone, :email, :data_nascimento, :password, :obs, :nivel)");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":nif", $nif);
	$resultado->bindValue(":cc", $cc);
	$resultado->bindValue(":telefone", $telefone);
	$resultado->bindValue(":email", $email);
	$resultado->bindValue(":data_nascimento", $data_nascimento);
	$resultado->bindValue(":password", NULL);
	$resultado->bindValue(":obs", $obs);
	$resultado->bindValue(":nivel", "Paciente");

	$resultado->execute();
	


	echo "Registado com Sucesso!";

}
else
{
	echo "Este Paciente Já Existe!";
}


?>