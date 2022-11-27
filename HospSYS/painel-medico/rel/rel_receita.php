<?php 

$id = $_GET['id'];


include('../../conexao.php');



 ?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<style>

@page {
		margin: 0px;

	}

	.imagem {
width: 100%;
}	

.nome-paciente {
position: absolute;
margin-top: 210px;
color:#5b5b5b;
font-size:15px;
margin-left: 160px;

}


.idade {
position: absolute;
margin-top: 206px;
color:#5b5b5b;
font-size:18px;
margin-left: 680px;

}

.endereco {
position: absolute;
margin-top: 233px;
color:#5b5b5b;
font-size:15px;
margin-left: 170px;

}


.itens {
position: absolute;
margin-top: 320px;
color:#5b5b5b;
font-size:16px;
margin-left: 50px;
width:100%;

}

</style>


<body>

		<?php
                      
					$res = $pdo->query("SELECT * from consultas where id = '$id'");
					$dados = $res->fetchAll(PDO::FETCH_ASSOC);

                    $row = count($dados);
				  			
				  			

							  for ($i=0; $i < count($dados); $i++) { 
								foreach ($dados[$i] as $key => $value) {
								}
							 
								$paciente = $dados[$i]['paciente'];
								$medico = $dados[$i]['medico'];
								$data = $dados[$i]['data'];
								$atestado = $dados[$i]['atestado'];
								$hora = $dados[$i]['hora'];

								$data2 = implode('/', array_reverse(explode('-', $data)));
								
							  
								//Buscar o nome do medico
								$res_medico = $pdo->query("SELECT * from utilizadores where id = '$medico'");
								$dados_medico = $res_medico->fetchAll(PDO::FETCH_ASSOC);
								$nome_medico = $dados_medico[0]['nome'];
								$cedula = $dados_medico[0]['cedula'];

								//Buscar o nome do paciente
								$res_paciente = $pdo->query("SELECT * from utilizadores where id = '$paciente'");
								$dados_paciente = $res_paciente->fetchAll(PDO::FETCH_ASSOC);
								$nome_paciente = $dados_paciente[0]['nome'];
								$nif_paciente = $dados_paciente[0]['nif'];
							
							}
                         
                            ?>


	<div class="nome-paciente"> <?php echo $nome_paciente; ?></div>

    <div class="itens">

			
			<?php 

			$res_presc = $pdo->query("SELECT * from receitas where id_consulta = '$id'");
			$dados_presc = $res_presc->fetchAll(PDO::FETCH_ASSOC);
                        //$dado = mysqli_fetch_array($result);
			$row_presc = count($dados_presc);

			for ($i=0; $i < count($dados_presc); $i++) { 
				foreach ($dados_presc[$i] as $key => $value) {
				}

				
				$item = $dados_presc[$i]['item'];
				$remedio = $dados_presc[$i]['remedio'];
				?>
				

				
					 <?php echo $item; ?> ------------------------ <?php echo $remedio; ?> 



				<br>

			<?php }  ?>
	

	</div>

	<img class="imagem" src="../../img/receita-fundo.png">


</body>