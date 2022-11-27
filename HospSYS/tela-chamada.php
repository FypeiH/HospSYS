<?php 

require_once("conexao.php");
require_once("config.php");


echo "<meta HTTP-EQUIV='refresh' CONTENT='$tempo_atualizacao_tela_chamadas;URL=tela-chamada.php'>"; 



?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>HOSPSYS</title>

	
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="css/painel.css" crossorigin="anonymous">


</head>
<body>




<?php 

//BUSCAR NA CONSULTA O ID DO PACIENTE E O ID DO MÉDICO
$res_con = $pdo->query("SELECT * from chamadas where id = 1");
	$dados_con = $res_con->fetchAll(PDO::FETCH_ASSOC);
	$linhas_con = count($dados_con);

	if($linhas_con > 0){

		$paciente = $dados_con[0]['paciente'];	
		$consultorio = $dados_con[0]['consultorio'];	
		$status = $dados_con[0]['status'];	

	}


//Buscar o nome do paciente

$res_paciente = $pdo->query("SELECT * from utilizadores where id = '$paciente'");
$dados_paciente = $res_paciente->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados_paciente);

if($linhas > 0)
{

  $nome_paciente = $dados_paciente[0]['nome']; 

}




if($status == 'a Chamar'){
		
echo '<audio autoplay="true">
	<source src="img/senha.mp3" type="audio/mpeg" />
	</audio>';


$texto = 'text-warning';

	//trocar o status para a aguardar

$res = $pdo->query("UPDATE chamadas set status = 'a Aguardar' where id = 1 ");

	}else{
		$texto = 'text-light';
	}

 ?>



<div class="container-tela-chamadas" align="center">
<big><big><big><big><big><big><big><big><big>


<span class="<?php echo $texto ?>"><?php echo strtoupper($nome_paciente) ?> <br>

</big></big></big></big>

<span class="text-light">CONSULTÓRIO <?php echo $consultorio ?><br>

</big></big>

</div>

</body>
</html>


