<?php 

require_once("../../conexao.php");


$id = $_POST['id'];
$dias = $_POST['dias'];



$resultado = $pdo->prepare("UPDATE consultas set atestado = :dias where id = :id");

$resultado->bindValue(":dias", $dias);
$resultado->bindValue(":id", $id);

$resultado->execute();


echo "Editado com Sucesso!";




?>