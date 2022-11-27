<div class="area_cards">
	<div class="row">

		<?php 
		

		if($valor_1 > 0){


			?>



			<div class="col-sm-12 col-lg-4 col-md-6 col-sm-6 mb-4">
				<div class="card card-stats">
					<div class="card-body ">
						<div class="row">
							<div class="col-5 col-md-4">
								<div class="icone-card text-center text-warning">
									<i class="fas fa-file-medical"></i>
								</div>
							</div>
							<div class="col-7 col-md-8">
								<div class="numbers">
									<p class="titulo-card">Nº. de Remédios em Risco</p>
									<p class="subtitulo-card"><?php echo $valor_1 ?><p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer rodape-card">
							Remédios com Stock Baixo!

						</div>
					</div>
				</div>

				<?php
			}
			?>
			

		


		

		<?php 
		

		if($valor_2 > 0){


			?>

			

			<div class="col-sm-12 col-lg-4 col-md-6 col-sm-6 mb-4">
				<div class="card card-stats">
					<div class="card-body ">
						<div class="row">
							<div class="col-5 col-md-4">
								<div class="icone-card text-center text-success">
									<i class="fas fa-coins"></i>
								</div>
							</div>
							<div class="col-7 col-md-8">
								<div class="numbers">
									<p class="titulo-card">Contas a Receber</p>
									<p class="subtitulo-card"><?php echo $valor_2 ?><p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer rodape-card">
							Contas a Vencer Hoje!

						</div>
					</div>
				</div>

				<?php
			}
			?>




			<?php 
		

		if($valor_3 > 0){


			?>

			

			<div class="col-sm-12 col-lg-4 col-md-6 col-sm-6 mb-4">
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
									<p class="titulo-card">Contas a Pagar</p>
									<p class="subtitulo-card"><?php echo $valor_3 ?><p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer rodape-card">
							Contas a Vencer Hoje!

						</div>
					</div>
				</div>

				<?php
			}
			?>




			<?php 


	

		if($valor_4 > 0){


			?>

			

			<div class="col-sm-12 col-lg-4 col-md-6 col-sm-6 mb-4">
				<div class="card card-stats">
					<div class="card-body ">
						<div class="row">
							<div class="col-5 col-md-4">
								<div class="icone-card text-center text-info">
									<i class="fas fa-stethoscope"></i>
								</div>
							</div>
							<div class="col-7 col-md-8">
								<div class="numbers">
									<p class="titulo-card">Consultas Atrasadas</p>
									<p class="subtitulo-card"><?php echo $valor_4 ?><p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer rodape-card">
							Contas em Atraso!

						</div>
					</div>
				</div>

				<?php
			}
			?>
			

	
		</div>

	</div>