<?php 

require_once("conexao.php");

	@session_start();

	$id = $_SESSION['id_utilizador'];
	$status = "Offline";

	$resultado = $pdo->prepare("UPDATE utilizadores set status = :status where id = :id");

	$resultado->bindValue(":status", $status);
	$resultado->bindValue(":id", $id);

	$resultado->execute();


	@session_destroy();

	header('location:index.php');

 ?>