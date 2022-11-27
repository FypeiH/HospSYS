<?php 

require_once("../../conexao.php");


$id = $_POST['id'];



$resultado = $pdo->prepare("UPDATE consultas set status = :status where id = :id");

$resultado->bindValue(":status", 'Finalizada');
$resultado->bindValue(":id", $id);

$resultado->execute();


 //Buscar o atendimento da consulta

 $res_atendimento = $pdo->query("SELECT * from consultas where id = '$id'");
 $dados_atendimento = $res_atendimento->fetchAll(PDO::FETCH_ASSOC);
 $tipo_atendimento = $dados_atendimento[0]['tipo_atendimento'];

 //Buscar o valor da consulta

 $res_valor = $pdo->query("SELECT * from consultas where id = '$id'");
 $dados_valor = $res_valor->fetchAll(PDO::FETCH_ASSOC);
 $valor = $dados_valor[0]['valor'];

//Buscar a data da consulta

$res_data = $pdo->query("SELECT * from consultas where id = '$id'");
$dados_data = $res_data->fetchAll(PDO::FETCH_ASSOC);
$data = $dados_data[0]['data'];


//Inserir dados na tabela de contas a receber

$resultado_c = $pdo->prepare("INSERT into contas_receber (descricao, valor, vencimento, id_consulta) values (:descricao, :valor, :vencimento, :id_consulta)");

$resultado_c->bindValue(":descricao", $tipo_atendimento);
$resultado_c->bindValue(":valor", $valor);
$resultado_c->bindValue(":vencimento", $data);
$resultado_c->bindValue(":id_consulta", $id);

$resultado_c->execute();


echo "Editado com Sucesso!";




?>