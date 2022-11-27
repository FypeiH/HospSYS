<?php 

require_once("../../conexao.php");


$data = $_POST['data'];
$hora = $_POST['hora'];
$paciente = $_POST['txtid'];
$tipo_atendimento = $_POST['atendimentos'];
$medico = $_POST['medico'];


$res_valor = $pdo->query("SELECT * from atendimentos where id = '$tipo_atendimento'");
$dados_valor = $res_valor->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados_valor);


if($linhas > 0)
{
	
	$valor = $dados_valor[0]['valor']; 

}





$resultado = $pdo->prepare("INSERT into consultas (data, hora, paciente, tipo_atendimento, medico, valor, estado_pagamento, status) values (:data, :hora, :paciente, :tipo_atendimento, :medico, :valor, :estado_pagamento, :status)");

$resultado->bindValue(":data", $data);
$resultado->bindValue(":hora", $hora);
$resultado->bindValue(":paciente", $paciente);
$resultado->bindValue(":tipo_atendimento", $tipo_atendimento);
$resultado->bindValue(":medico", $medico);
$resultado->bindValue(":valor", $valor);
$resultado->bindValue(":estado_pagamento", 'Não');
$resultado->bindValue(":status", 'a Aguardar');

$resultado->execute();


echo "Registado com Sucesso!";


?>