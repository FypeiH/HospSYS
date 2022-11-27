<?php 

require_once("../../conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$cedula = $_POST['cedula'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];
$data_entrada = $_POST['data_entrada'];
$campo_antigo = $_POST['campo_antigo'];

//Pesquisar os dados do registo a ser editado

$resultado = $pdo->query("SELECT * from utilizadores where id = '$id'");

$dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

$cc = $dados[0]['cc'];
$nif = $dados[0]['nif'];


//Buscar o id do cargo
$resultado_cargo = $pdo->query("SELECT * from cargos where nome = 'Farmacêutico' or nome = 'Farmaceutico' or nome = 'farmacêutico' or nome = 'farmaceutico'");
$dados_cargo = $resultado_cargo->fetchAll(PDO::FETCH_ASSOC);
$id_cargo = $dados_cargo[0]['id'];


$resultado = $pdo->prepare("UPDATE utilizadores set nome = :nome, email = :email, nif = :nif, cc = :cc, telefone = :telefone, data_nascimento = :data_nascimento, data_entrada = :data_entrada, cedula = :cedula, especialidade = :especialidade, password = :password, nivel = :nivel where id = :id");

$resultado->bindValue(":nome", $nome);
$resultado->bindValue(":especialidade", NULL);
$resultado->bindValue(":cedula", $cedula);
$resultado->bindValue(":nif", $nif);
$resultado->bindValue(":cc", $cc);
$resultado->bindValue(":data_nascimento", $data_nascimento);
$resultado->bindValue(":data_entrada", $data_entrada);
$resultado->bindValue(":telefone", $telefone);
$resultado->bindValue(":email", $email);
$resultado->bindValue(":id", $id);

$nif_sem_pontos = preg_replace('/[^0-9]/', '', $nif);

$resultado->bindValue(":password",md5($nif_sem_pontos));
$resultado->bindValue(":nivel", 'Farmacêutico');

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


echo "Editado com Sucesso!";




?>