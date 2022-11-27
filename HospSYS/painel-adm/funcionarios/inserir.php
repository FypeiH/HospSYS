<?php 

require_once("../../conexao.php");


$nome = $_POST['nome'];
$nif = $_POST['nif'];
$cc = $_POST['cc'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];
$data_entrada = $_POST['data_entrada'];
$cargo = $_POST['cargo'];


  //Verificar se o funcionario existe

$resultado_verificar = $pdo->query("SELECT * from funcionarios where nif = '$nif'");

$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados_verificar);

if($linhas == 0)
{

	$resultado = $pdo->prepare("INSERT into funcionarios (nome, email, nif, cc, telefone, data_nascimento, data_entrada, cargo) values (:nome, :email, :nif, :cc, :telefone, :data_nascimento, :data_entrada, :cargo)");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":nif", $nif);
	$resultado->bindValue(":cc", $cc);
	$resultado->bindValue(":data_nascimento", $data_nascimento);
	$resultado->bindValue(":data_entrada", $data_entrada);
	$resultado->bindValue(":telefone", $telefone);
	$resultado->bindValue(":email", $email);;
	$resultado->bindValue(":cargo", $cargo);

	$resultado->execute();


	echo "Registado com Sucesso!";

}
else
{
	echo "Este Funcionário Já Existe!";
}


?>