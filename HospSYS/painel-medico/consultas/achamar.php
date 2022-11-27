<?php 

require_once("../../conexao.php");


$id = $_POST['id'];


//Buscar o id do paciente e do médico

$res_con = $pdo->query("SELECT * from consultas where id = '$id'");
$dados_con = $res_con->fetchAll(PDO::FETCH_ASSOC);
$linhas_con = count($dados_con);

if($linhas_con > 0)
  {

    $paciente = $dados_con[0]['paciente']; 
    $medico = $dados_con[0]['medico']; 

  }

  //Buscar o nome do médico

  $res_medico = $pdo->query("SELECT * from utilizadores where id = '$medico'");
  $dados_medico = $res_medico->fetchAll(PDO::FETCH_ASSOC);
  $linhas = count($dados_medico);

  if($linhas > 0)
  {

    $consultorio = $dados_medico[0]['consultorio']; 

  }

//Atualizar a Tabela de Chamadas

$resultado = $pdo->prepare("UPDATE chamadas set paciente = :paciente, consultorio = :consultorio, status = :status where id = :id");

$resultado->bindValue(":paciente", $paciente);
$resultado->bindValue(":consultorio", $consultorio);
$resultado->bindValue(":status", 'a Chamar');
$resultado->bindValue(":id", 1);

$resultado->execute();



echo "Editado com Sucesso!";




?>