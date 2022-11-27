<?php 

require_once("../../conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];
$data_entrada = $_POST['data_entrada'];
$nif_antigo = $_POST['campo_antigo'];
$cargo = $_POST['cargo'];

//Pesquisar os dados do registo a ser editado

$resultado = $pdo->query("SELECT * from funcionarios where id = '$id'");

$dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

$cc = $dados[0]['cc'];
$nif = $dados[0]['nif'];



$resultado = $pdo->prepare("UPDATE funcionarios set nome = :nome, email = :email, nif = :nif, cc = :cc, telefone = :telefone, data_nascimento = :data_nascimento, data_entrada = :data_entrada, cargo = :cargo where id = :id");

$resultado->bindValue(":nome", $nome);
$resultado->bindValue(":nif", $nif);
$resultado->bindValue(":cc", $cc);
$resultado->bindValue(":data_nascimento", $data_nascimento);
$resultado->bindValue(":data_entrada", $data_entrada);
$resultado->bindValue(":telefone", $telefone);
$resultado->bindValue(":email", $email);
$resultado->bindValue(":id", $id);
$resultado->bindValue(":cargo", $cargo);

$resultado->execute();

echo "Editado com Sucesso!";




?>