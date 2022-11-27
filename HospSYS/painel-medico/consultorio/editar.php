<?php 

require_once("../../conexao.php");

$consultorio = $_POST['consultorio'];
$id = $_POST['id'];


$resultado = $pdo->prepare("UPDATE utilizadores set consultorio = :consultorio where id = :id");

$resultado->bindValue(":consultorio", $consultorio);
$resultado->bindValue(":id", $id);

$resultado->execute();

echo "Editado com Sucesso!";




?>