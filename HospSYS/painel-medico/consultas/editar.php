<?php 

require_once("../../conexao.php");


$id = $_POST['id'];
$obs = $_POST['obs'];



$resultado = $pdo->prepare("UPDATE utilizadores set obs = :obs where id = :id");

$resultado->bindValue(":obs", $obs);
$resultado->bindValue(":id", $id);

$resultado->execute();


echo "Editado com Sucesso!";




?>