 
<?php 


$res_1 = $pdo->query("SELECT * from utilizadores where nivel = 'Médico' ");
$dados_1 = $res_1->fetchAll(PDO::FETCH_ASSOC);
$valor_1 = count($dados_1);


//TOTALIZAR AS MOVIMENTAÇÕES
$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_inicial = $ano_atual.'-'.$mes_atual.'-01';


$res = $pdo->query("SELECT * from movimentacoes where data >= '$data_inicial' and data <= curDate()");

$dados = $res->fetchAll(PDO::FETCH_ASSOC);

$total_entradas = 0;
$total_saidas = 0;

for ($i=0; $i < count($dados); $i++) { 
	foreach ($dados[$i] as $key => $value) {
	}

	$id = $dados[$i]['id'];	
	$tipo = $dados[$i]['tipo'];
	$valor = $dados[$i]['valor'];
	

	if($tipo == 'Entrada'){
		@$total_entradas = $total_entradas + $valor;
	}else{
		@$total_saidas = $total_saidas + $valor;
	}

}

@$total = @$total_entradas - @$total_saidas;
if(@$total >= 0){
	$classe_valor = 'text-success';
}else{
	$classe_valor = 'text-danger';
}




$res_3 = $pdo->query("SELECT * from consultas where status = 'Finalizada' and (data >= '$data_inicial' and data <= curDate() ) ");
$dados_3 = $res_3->fetchAll(PDO::FETCH_ASSOC);
$valor_3 = count($dados_3);


$res_4 = $pdo->query("SELECT * from funcionarios ");
$dados_4 = $res_4->fetchAll(PDO::FETCH_ASSOC);
$valor_4 = count($dados_4);


$res_6 = $pdo->query("SELECT * from consultas where estado_pagamento != 'Sim' ");
$dados_6 = $res_6->fetchAll(PDO::FETCH_ASSOC);
$valor_6 = count($dados_6);

 ?>


<div class="area_cards">
	<div class="row">

		<div class="col-sm-12 col-lg-4 col-md-6 col-sm-6 mb-4">
			<div class="card card-stats">
				<div class="card-body ">
					<div class="row">
						<div class="col-5 col-md-4">
							<div class="icone-card text-center text-info">
								<i class="fas fa-user-md"></i>
							</div>
						</div>
						<div class="col-7 col-md-8">
							<div class="numbers">
								<p class="titulo-card">Total de Médicos</p>
								<p class="subtitulo-card"><?php echo $valor_1 ?><p>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer rodape-card">
						Total de Médicos Registados

					</div>
				</div>
			</div>


			<div class="col-lg-4 col-md-6 col-sm-6 mb-4">
			<div class="card card-stats">
				<div class="card-body ">
					<div class="row">
						<div class="col-5 col-md-4">
							<div class="icone-card text-center <?php echo $classe_valor ?>">
								<i class="fas fa-euro-sign"></i>
							</div>
						</div>
						<div class="col-7 col-md-8">
							<div class="numbers">
								<p class="titulo-card">Total de Receita</p>
								<p class="subtitulo-card <?php echo $classe_valor ?>"><?php echo round($total) ?> €<p>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer rodape-card">
						Valor Total do Mês

					</div>
				</div>
			</div>


			<div class="col-lg-4 col-md-6 col-sm-6 mb-4">
			<div class="card card-stats">
				<div class="card-body ">
					<div class="row">
						<div class="col-5 col-md-4">
							<div class="icone-card text-center text-info">
								<i class="fas fa-notes-medical"></i>
							</div>
						</div>
						<div class="col-7 col-md-8">
							<div class="numbers">
								<p class="titulo-card">Total de Consultas</p>
								<p class="subtitulo-card"><?php echo $valor_3 ?><p>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer rodape-card">
						Total de Consultas no Mês

					</div>
				</div>
			</div>




			<div class="col-lg-4 col-md-6 col-sm-6 mb-4 card-adm">
			<div class="card card-stats">
				<div class="card-body ">
					<div class="row">
						<div class="col-5 col-md-4">
							<div class="icone-card text-center icon-warning">
								<i class="fas fa-user-nurse"></i>
							</div>
						</div>
						<div class="col-7 col-md-8">
							<div class="numbers">
								<p class="titulo-card">Total de Funcionários</p>
								<p class="subtitulo-card"><?php echo $valor_4 ?><p>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer rodape-card">
						Total de Funcionários Registados

					</div>
				</div>
			</div>





			<div class="col-lg-4 col-md-6 col-sm-6 mb-4 card-adm">
			<div class="card card-stats">
				<div class="card-body ">
					<div class="row">
						<div class="col-5 col-md-4">
							<div class="icone-card text-center text-danger">
								<i class="fas fa-money-check-alt"></i>
							</div>
						</div>
						<div class="col-7 col-md-8">
							<div class="numbers">
								<p class="titulo-card">Total de Gastos</p>
								<p class="subtitulo-card"><span class="text-danger"><?php echo round($total_saidas) ?> €</span><p>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer rodape-card">
						Total de Gastos no Mês

					</div>
				</div>
			</div>




			<div class="col-lg-4 col-md-6 col-sm-6 mb-4 card-adm">
			<div class="card card-stats">
				<div class="card-body ">
					<div class="row">
						<div class="col-5 col-md-4">
							<div class="icone-card text-center text-warning">
								<i class="fas fa-stethoscope"></i>
							</div>
						</div>
						<div class="col-7 col-md-8">
							<div class="numbers">
								<p class="titulo-card">Consultas Agendadas</p>
								<p class="subtitulo-card"><?php echo $valor_6 ?><p>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer rodape-card">
						Total de Consultas Agendadas

					</div>
				</div>
			</div>




		</div>
	</div>