<?php 

require_once("../../conexao.php");
$id = $_POST['id_consulta'];
$item = $_POST['item_receita'];
$remedio = $_POST['remedio'];


$res = $pdo->prepare("INSERT into receitas (id_consulta, item, remedio) values (:id_consulta, :item, :remedio)");

	$res->bindValue(":id_consulta", $id);
	$res->bindValue(":item", $item);
	$res->bindValue(":remedio", $remedio);

	

	$res->execute();



//atualizar o campo prescricao na tabela consulta
	$res = $pdo->query("UPDATE consultas SET receita = 'Sim' where id = '$id' ");


echo "Salvo com Sucesso!!";





?>