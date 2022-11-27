<?php 

	
//Verificar se existem consultas não confirmadas que já passaram da data

$resultado_ex = $pdo->query("SELECT * from consultas where data < curDate() AND estado_pagamento != 'Sim' and medico = $id_utilizador");

$dados_ex = $resultado_ex->fetchAll(PDO::FETCH_ASSOC);


for ($i=0; $i < count($dados_ex); $i++) { 
  foreach ($dados_ex[$i] as $key => $value) {
  }

  $id = $dados_ex[$i]['id']; 

  $pdo->query("DELETE from consultas where id = '$id'");

}

//Contar as consultas pendentes

$resultado_pend = $pdo->query("SELECT * from consultas where data = curDate() and estado_pagamento != 'Sim' and medico = $id_utilizador");
$dados_pend = $resultado_pend->fetchAll(PDO::FETCH_ASSOC);
$valor_pend = count($dados_pend);


//Contar as consultas do dia atual

$resultado_hoje = $pdo->query("SELECT * from consultas where data = curDate() and estado_pagamento = 'Sim' and medico = $id_utilizador");
$dados_hoje = $resultado_hoje->fetchAll(PDO::FETCH_ASSOC);
$valor_hoje = count($dados_hoje);

//Contar as consultas a aguardar

$resultado_aguar = $pdo->query("SELECT * from consultas where data = curDate() and status = 'a Aguardar' and medico = $id_utilizador");
$dados_aguar = $resultado_aguar->fetchAll(PDO::FETCH_ASSOC);
$valor_aguar = count($dados_aguar);


 ?>


<div class="area_cards">
	<div class="row">
	
		<div class="col-sm-12 col-lg-4 col-md-6 col-sm-6 mb-4">
			<div class="card card-stats">
				<div class="card-body ">
					<div class="row">
						<div class="col-5 col-md-4">
							<div class="icone-card text-center text-warning">
								<i class="fas fa-stethoscope"></i>
							</div>
						</div>
						<div class="col-7 col-md-8">
							<div class="number">
								<p class="titulo-card">Consultas Pendentes</p>
								<p class="subtitulo-card"><?php echo $valor_pend; ?></p>
							</div>
						</div>
					</div>
				</div>

					<div class="card-footer rodape-card">
						A Aguardar Pagamentos

					</div>
			</div>
		</div>


		<div class="col-lg-4 col-md-6 col-sm-6 mb-4">
			<div class="card card-stats">
				<div class="card-body ">
					<div class="row">
						<div class="col-5 col-md-4">
							<div class="icone-card text-center text-success">
								<i class="far fa-calendar-alt"></i>
							</div>
						</div>
						<div class="col-7 col-md-8">
							<div class="number">
								<p class="titulo-card">Consultas de Hoje</p>
								<p class="subtitulo-card"><?php echo $valor_hoje; ?></p>
							</div>
						</div>
					</div>
				</div>

					<div class="card-footer rodape-card">
						Agendamento para Hoje

					</div>
			</div>
		</div>


		<div class="col-lg-4 col-md-6 col-sm-6 mb-4">
			<div class="card card-stats">
				<div class="card-body ">
					<div class="row">
						<div class="col-5 col-md-4">
							<div class="icone-card text-center  text-danger">
								<i class="far fa-calendar-alt"></i>
							</div>
						</div>
						<div class="col-7 col-md-8">
							<div class="number">
								<p class="titulo-card">Consultas a Aguardar</p>
								<p class="subtitulo-card"><?php echo $valor_aguar; ?></p>
							</div>
						</div>
					</div>
				</div>

					<div class="card-footer rodape-card">
						A Aguardar Atendimentos

					</div>
			</div>
		</div>

	</div>
</div>


<div class="mt-4">

<span class="badge bg-light">Próximas Consultas</span>


	<?php 

echo '
<table class="table table-sm mt-3">
  <thead class="thead-light">
    <tr>
	<th scope="col">Paciente</th>
	<th scope="col">Hora</th>
	<th scope="col">Atendimento</th>
	<th scope="col">Médico</th>
    </tr>
  </thead>
  <tbody>';

  $res = $pdo->query("SELECT * from consultas where data = curDate() and status = 'a Aguardar' and medico = $id_utilizador order by hora asc LIMIT 6");
  
  $dados = $res->fetchAll(PDO::FETCH_ASSOC);


  for ($i=0; $i < count($dados); $i++) { 
      foreach ($dados[$i] as $key => $value) {
      }

	  $id = $dados[$i]['id']; 
	  $paciente = $dados[$i]['paciente'];
	  $hora = $dados[$i]['hora'];
	  $tipo_atendimento = $dados[$i]['tipo_atendimento'];
	  $medico = $dados[$i]['medico'];


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

  }


  //Buscar o nome do atendimento

  $res_atend = $pdo->query("SELECT * from atendimentos where id = '$tipo_atendimento'");
  $dados_atend = $res_atend->fetchAll(PDO::FETCH_ASSOC);
  $linhas = count($dados_atend);


  if($linhas > 0)
  {

    $descricao_atend = $dados_atend[0]['descricao']; 

  }
      


echo '
    <tr>

	<td>'.$nome_paciente.'</td>
	<td>'.$hora.'</td>
	<td>'.@$descricao_atend.'</td>
	<td>'.@$nome_medico.'</td>
      
    </tr>';

  }

echo  '
  </tbody>
</table> ';



?>

</div>


