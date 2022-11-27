<?php 

require_once("../../conexao.php");

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];
$obs = $_POST['obs'];


$id = $_POST['id'];
$campo_antigo = $_POST['campo_antigo'];

//Pesquisar os dados do registo a ser editado

$resultado = $pdo->query("SELECT * from utilizadores where id = '$id'");

$dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

$cc = $dados[0]['cc'];
$nif = $dados[0]['nif'];


$resultado = $pdo->prepare("UPDATE utilizadores set nome = :nome, email = :email, nif = :nif, cc = :cc, telefone = :telefone, data_nascimento = :data_nascimento, obs = :obs, nivel = :nivel where id = :id");

$resultado->bindValue(":nome", $nome);
$resultado->bindValue(":email", $email);
$resultado->bindValue(":nif", $nif);
$resultado->bindValue(":cc", $cc);
$resultado->bindValue(":telefone", $telefone);
$resultado->bindValue(":data_nascimento", $data_nascimento);
$resultado->bindValue(":obs", $obs);
$resultado->bindValue(":nivel", 'Paciente');
$resultado->bindValue(":id", $id);

$resultado->execute();

echo "Editado com Sucesso!";




?>