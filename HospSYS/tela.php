<?php 

require_once("config.php");
require_once("conexao.php");

?>


<!DOCTYPE html>
<html lang="pt-pt">
<head>
	<title>HospSYS TELA</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/painel.css">
</head>

<body>

<div class="container-tela">
<big><big>
<table class="table table-lg mt-3">
<thead class="thead-light">
<tr>
<th scope="col">Paciente</th>
<th scope="col">Hora</th>
<th scope="col">Atendimento</th>
<th scope="col">Médico</th>
<th scope="col">Consultório</th>
</tr>
</thead>
<tbody>

<?php

$itens_por_pagina = $itens_tela;

$pagina_pag = intval(@$_GET['pagina']);

$limite = $pagina_pag * $itens_por_pagina;

$caminho_pag = 'tela.php?';

$res = $pdo->query("SELECT * from consultas where data = curDate() and status = 'a Aguardar' or status = 'a Consultar' order by hora asc LIMIT $limite, $itens_por_pagina");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);


	//Totalizar os Registos para a Paginação 
  $resultado_todos = $pdo->query("SELECT * from consultas where data = curDate() and estado_pagamento = 'Não'");
  $dados_total = $resultado_todos->fetchAll(PDO::FETCH_ASSOC);
  $num_total = count($dados_total);

  //Definir o Total de Páginas

  $num_paginas = ceil($num_total/$itens_por_pagina);


for ($i=0; $i < count($dados); $i++) { 
  foreach ($dados[$i] as $key => $value) {
  }

  $id = $dados[$i]['id']; 
  $paciente = $dados[$i]['paciente'];
  $hora = $dados[$i]['hora'];
  $tipo_atendimento = $dados[$i]['tipo_atendimento'];
  $medico = $dados[$i]['medico'];
  $valor = $dados[$i]['valor'];
  $estado_pagamento = $dados[$i]['estado_pagamento'];
  $status = $dados[$i]['status'];

  //Buscar o nome do paciente

  $res_paciente = $pdo->query("SELECT * from utilizadores where id = '$paciente'");
  $dados_paciente = $res_paciente->fetchAll(PDO::FETCH_ASSOC);
  $linhas = count($dados_paciente);


  if($linhas > 0)
  {

    $nome_paciente = $dados_paciente[0]['nome']; 

  }

  //Buscar o nome do medico

  $res_medico = $pdo->query("SELECT * from utilizadores where nivel = 'Médico' and id = '$medico'");
  $dados_medico = $res_medico->fetchAll(PDO::FETCH_ASSOC);
  $linhas = count($dados_medico);


  if($linhas > 0)
  {

    $nome_medico = $dados_medico[0]['nome']; 
    $consultorio = $dados_medico[0]['consultorio']; 

  }


  //Buscar o nome do atendimento

  $res_atend = $pdo->query("SELECT * from atendimentos where id = '$tipo_atendimento'");
  $dados_atend = $res_atend->fetchAll(PDO::FETCH_ASSOC);
  $linhas = count($dados_atend);


  if($linhas > 0)
  {

    $descricao_atend = $dados_atend[0]['descricao']; 

  }


  if($status == 'a Consultar')
  {
    echo '<tr class="table-primary" >';
  }else{
    echo '<tr>';
  }
?>

  <td><?php echo $nome_paciente; ?></td>
  <td><?php echo $hora; ?></td>
  <td><?php echo @$descricao_atend; ?></td>
  <td><?php echo @$nome_medico; ?></td>
  <td><?php echo @$consultorio; ?> - <small><small><?php echo $status; ?></small></small></td>

<?php } ?>


</tbody>
</table>

<!--Área de Paginação-->

<nav class="paginacao" aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item">
        <a class="btn btn-outline-light btn-sm mr-1" href="<?php echo $caminho_pag; ?> pagina=0&itens=<?php echo $itens_por_pagina; ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>
       
      <?php 
      
      for($i=0;$i<$num_paginas;$i++)
      {
        $estilo = "";
        if($pagina_pag == $i)
        {
          $estilo = "active";
        } 

      ?>
        
     	
     		<li class="page-item"><a class="btn btn-outline-light btn-sm mr-1 <?php echo $estilo; ?>" href="<?php echo $caminho_pag; ?>pagina=<?php echo $i; ?>&itens=<?php echo $itens_por_pagina; ?> "><?php echo $i+1; ?></a></li>
      
      <?php } ?>

      	<li class="page-item">
        <a class="btn btn-outline-light btn-sm" href="<?php echo $caminho_pag; ?>pagina=<?php echo $num_paginas-1; ?>&itens=<?php echo $itens_por_pagina;?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>
    </ul>
  </nav>

</big></big>
</div>
</body>
</html>

<?php 

if(!isset($_GET['pagina']) || $_GET['pagina'] >= ($num_paginas - 1)){
	echo "<meta HTTP-EQUIV='refresh' CONTENT='$tempo_atualizacao_tela;URL=tela.php?pagina=0'>"; 
}else{
	$valor = @$_GET['pagina'] + 1;
	echo "<meta HTTP-EQUIV='refresh' CONTENT='$tempo_atualizacao_tela;URL=tela.php?pagina=$valor'>"; 
}

 ?>