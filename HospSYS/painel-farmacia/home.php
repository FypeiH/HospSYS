<?php 

	
//Verificar a quantidade de remédios com o stock baixo

$resultado_nivel = $pdo->query("SELECT * from remedios where stock <= '$nivel_stock' ");

$dados_nivel = $resultado_nivel->fetchAll(PDO::FETCH_ASSOC);

$stock_baixo = count($dados_nivel);


//Verificar a quantidade de remédios que entraram no dia atual

$resultado_entrada = $pdo->query("SELECT * from entradas_remedios where data = CurDate() ");

$dados_entrada = $resultado_entrada->fetchAll(PDO::FETCH_ASSOC);

$stock_entrada = count($dados_entrada);

//Verificar a quantidade de remédios que sairam no dia atual

$resultado_saida = $pdo->query("SELECT * from saidas_remedios where data = CurDate() ");

$dados_saida = $resultado_saida->fetchAll(PDO::FETCH_ASSOC);

$stock_saida = count($dados_saida);


 ?>


<div class="area_cards">
	<div class="row">
	
		<div class="col-sm-12 col-lg-4 col-md-6 col-sm-6 mb-4">
			<div class="card card-stats">
				<div class="card-body ">
					<div class="row">
						<div class="col-5 col-md-4">
							<div class="icone-card text-center text-warning">
								<i class="fas fa-globe"></i>
							</div>
						</div>
						<div class="col-7 col-md-8">
							<div class="number">
								<p class="titulo-card">Stock Baixo</p>
								<p class="subtitulo-card"><?php echo $stock_baixo ?></p>
							</div>
						</div>
					</div>
				</div>

					<div class="card-footer rodape-card">
						Remédios com o Stock Baixo

					</div>
			</div>
		</div>


		<div class="col-lg-4 col-md-6 col-sm-6 mb-4">
			<div class="card card-stats">
				<div class="card-body ">
					<div class="row">
						<div class="col-5 col-md-4">
							<div class="icone-card text-center text-success">
								<i class="far fa-envelope-open"></i>
							</div>
						</div>
						<div class="col-7 col-md-8">
							<div class="number">
								<p class="titulo-card">Entradas de Remédios</p>
								<p class="subtitulo-card"><?php echo $stock_entrada ?></p>
							</div>
						</div>
					</div>
				</div>

					<div class="card-footer rodape-card">
						Total de Entradas Hoje

					</div>
			</div>
		</div>


		<div class="col-lg-4 col-md-6 col-sm-6 mb-4">
			<div class="card card-stats">
				<div class="card-body ">
					<div class="row">
						<div class="col-5 col-md-4">
							<div class="icone-card text-center text-danger">
								<i class="fas fa-sign-out-alt"></i>
							</div>
						</div>
						<div class="col-7 col-md-8">
							<div class="number">
								<p class="titulo-card">Saída de Remédios</p>
								<p class="subtitulo-card"><?php echo $stock_saida ?></p>
							</div>
						</div>
					</div>
				</div>

					<div class="card-footer rodape-card">
						Total de Saídas Hoje

					</div>
			</div>
		</div>

	</div>
<div class="mt-4">

<span class="badge bg-light">Remédios com Stock Baixo</span>


	<?php 

echo '
<table class="table table-sm mt-3">
  <thead class="thead-light">
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Descrição</th>
      <th scope="col">Stock</th>
    </tr>
  </thead>
  <tbody>';

  $res = $pdo->query("SELECT * from remedios where stock <= '$nivel_stock' order by stock asc");
  
  $dados = $res->fetchAll(PDO::FETCH_ASSOC);


  for ($i=0; $i < count($dados); $i++) { 
      foreach ($dados[$i] as $key => $value) {
      }

      $id = $dados[$i]['id']; 
      $nome = $dados[$i]['nome'];
      $descricao = $dados[$i]['descricao'];
      $stock = $dados[$i]['stock'];
      


echo '
    <tr>

      <td>'.$nome.'</td>
      <td>'.$descricao.'</td>
      <td>'.$stock.'</td>
      
    </tr>';

  }

echo  '
  </tbody>
</table> ';



?>

</div>

