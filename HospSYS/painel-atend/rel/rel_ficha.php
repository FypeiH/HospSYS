
<?php 

include('../../conexao.php');

$id = $_GET['id'];

?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<style>

 @page {
            margin: 0px;

        }

.footer {
    position:absolute;
    bottom:0;
    width:100%;
    background-color: #ebebeb;
    padding:10px;
}

.cabecalho {    
    background-color: #ebebeb;
    padding-top:15px;
    margin-bottom:30px;
}

.titulo{
	margin:0;
}

.areaTotais{
	border : 0.5px solid #bcbcbc;
	padding: 15px;
	border-radius: 5px;
	margin-right:25px;
}

.areaTotal{
	border : 0.5px solid #bcbcbc;
	padding: 15px;
	border-radius: 5px;
	margin-right:25px;
	background-color: #f9f9f9;
	margin-top:2px;
}

.pgto{
	margin:1px;
}

.dados{
	font-size:11px;
}



</style><style>

 @page {
            margin: 0px;

        }

.footer {
    position:absolute;
    bottom:0;
    width:100%;
    background-color: #ebebeb;
    padding:10px;
}

.cabecalho {    
    background-color: #ebebeb;
    padding-top:15px;
    margin-bottom:30px;
}

.titulo{
	margin:0;
}

.areaTotais{
	border : 0.5px solid #bcbcbc;
	padding: 15px;
	border-radius: 5px;
	margin-right:25px;
}

.areaTotal{
	border : 0.5px solid #bcbcbc;
	padding: 15px;
	border-radius: 5px;
	margin-right:25px;
	background-color: #f9f9f9;
	margin-top:2px;
}

.pgto{
	margin:1px;
}

.dados{
	font-size:11px;
}



</style><style>

@page {
		   margin: 0px;

	   }

.footer {
   position:absolute;
   bottom:0;
   width:100%;
   background-color: #ebebeb;
   padding:10px;
}

.cabecalho {    
   background-color: #ebebeb;
   padding-top:15px;
   margin-bottom:30px;
}

.titulo{
   margin:0;
}

.areaTotais{
   border : 0.5px solid #bcbcbc;
   padding: 15px;
   border-radius: 5px;
   margin-right:25px;
}

.areaTotal{
   border : 0.5px solid #bcbcbc;
   padding: 15px;
   border-radius: 5px;
   margin-right:25px;
   background-color: #f9f9f9;
   margin-top:2px;
}

.pgto{
   margin:1px;
}

.dados{
   font-size:11px;
}



</style>


<div class="cabecalho">
	
	<div class="row">
		<div class="col-sm-4">	
			<img src="../../img/logohorizontal.png" width="250px">
		</div>
		<div class="col-sm-6">	
			<h3 class="titulo"><b>HospSYS - Sistemas Hospitalares</b></h3>
			<h6 class="titulo">Rua NÃOSEIQUAL Nº 12, Alverca 2615-263</h6>
		</div>
	</div>
	

</div>

<div class="container">


<?php

$res = $pdo->query("SELECT * from utilizadores where id = '$id'");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);

for ($i=0; $i < count($dados); $i++) { 
foreach ($dados[$i] as $key => $value) {
}

$id = $dados[$i]['id'];	
$nome = $dados[$i]['nome'];
$nif = $dados[$i]['nif'];
$cc = $dados[$i]['cc'];
$telefone = $dados[$i]['telefone'];
$email = $dados[$i]['email'];
$data_nascimento = $dados[$i]['data_nascimento'];
$data_nascimento1 = implode('/', array_reverse(explode('-', $data_nascimento)));
$obs = $dados[$i]['obs'];

}  

//Buscar a foto do utilizador
$resultado_foto = $pdo->query("SELECT * from utilizadores where nif = '$nif'");
$dados_foto = $resultado_foto->fetchAll(PDO::FETCH_ASSOC);
$foto = $dados_foto[0]['foto'];
	


 ?>


<div class="row">
	<div class="col-sm-3">	
		<?php 
			if(count($dados_foto) > 0){
				echo '<img src="../../img/fotos-perfil/'.$foto.'" width="150px">';
			}else{
				echo '<img src="../../img/fotos-perfil/sem-foto.png" width="150px">';
			}
		 ?>
	  
	</div>


	<div class="col-sm-9">	
	   <big><big><?php echo $nome ?></big></big><br>
	   <span class="dados">Telefone: <?php echo $telefone ?> &nbsp; &nbsp; 
	   Email: <?php echo $email ?> </span><br>
		 <span class="dados">NIF: <?php echo $nif ?> &nbsp; &nbsp; Cartão de Cidadão: <?php echo $cc ?> </span><br>
		 <span class="dados">Data de Nascimento: <?php echo $data_nascimento1 ?></span><br>
	</div>
	
	
</div>



<hr>



			
<br><br>




<table class="table">
<tr bgcolor="#f9f9f9">
	<td style="font-size:12px"> <b>Observações</b> </td>
	
	
	
</tr>


	


	<tr>
	<td style="font-size:12px"> <?php echo $obs; ?> </td>

	
	
	</tr>


</table>




<hr>


<hr>




</div>


<div class="footer">
	<p style="font-size:12px" align="center">Desenvolvido por Filipe Bravo</p> 
</div>


