<?php 
require_once("conexao.php");
@session_start();


	$id = $_SESSION['id_utilizador'];
	$status = "Online";

	$resultado = $pdo->prepare("UPDATE utilizadores set status = :status where id = :id");

	$resultado->bindValue(":status", $status);
	$resultado->bindValue(":id", $id);

	$resultado->execute();
	
	if($_SESSION['nivel_utilizador'] == 'Admin')
	{
		header("location:painel-escolha/admin.php");
		exit();
	}

	if($_SESSION['nivel_utilizador'] == 'Médico')
	{
		header("location:painel-escolha/medico.php");
		exit();
	}

	if($_SESSION['nivel_utilizador'] == 'Recepcionista')
	{
		header("location:painel-escolha/recepcionista.php");
		exit();
	}
	if($_SESSION['nivel_utilizador'] == 'Tesoureiro')
	{
		header("location:painel-escolha/tesoureiro.php");
		exit();
	}
	if($_SESSION['nivel_utilizador'] == 'Farmacêutico')
	{
		header("location:painel-escolha/farmaceutico.php" );
		exit();
	}
	if($_SESSION['nivel_utilizador'] == 'Tela')
	{
		header("location:tela.php");
		exit();
	}
	if($_SESSION['nivel_utilizador'] == 'Paciente')
	{
		header("location:painel-paciente/index.php");
		exit();
	}




?>