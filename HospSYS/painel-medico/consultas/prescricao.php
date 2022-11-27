<?php 

require_once("../../conexao.php");
$id = $_POST['id_consulta'];
$item = $_POST['item'];
$remedio = $_POST['remedio'];


$res = $pdo->prepare("INSERT into prescricao (id_consulta, item, remedio) values (:id_consulta, :item, :remedio)");

	$res->bindValue(":id_consulta", $id);
	$res->bindValue(":item", $item);
	$res->bindValue(":remedio", $remedio);

	

	$res->execute();



//Atualizar o Campo Prescricao na Tabela Consulta
	$res = $pdo->query("UPDATE consultas SET prescricao = 'Sim' where id = '$id' ");


echo "Salvo com Sucesso!!";





?>