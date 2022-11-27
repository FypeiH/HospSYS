<?php 
@session_start();
require_once("../../conexao.php");
$pagina = 'consultas';

$id = $_POST['id_consulta'];


//Atualizar o item da prescrição
$res = $pdo->query("SELECT * from receitas where id_consulta = '$id' order by id desc");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$item = @$dados[0]['item'];
$num_item = $item + 1;
echo '<input type="hidden" id="num_item_receita"  name="num_item_receita" value="'.$num_item.'">';



echo '
<table class="table table-sm tabelas mt-3">
<thead class="thead-light">
<tr>
<th scope="col">Item</th>
<th scope="col">Remédio</th>

<th scope="col">Excluir</th>
</tr>
</thead>
<tbody>';


$id_medico = $_SESSION['id_utilizador'];


$res_espec = $pdo->query("SELECT * from receitas where id_consulta = '$id'");
$dados_espec = $res_espec->fetchAll(PDO::FETCH_ASSOC);


for ($i=0; $i < count($dados_espec); $i++) { 
	foreach ($dados_espec[$i] as $key => $value) {
	}

	$item = $dados_espec[$i]['item'];	
	$remedio = $dados_espec[$i]['remedio'];
	$id_prescricao = $dados_espec[$i]['id'];

	echo '
	<tr>


	
	<td>'.$item.'</td>
	<td>'.$remedio.'</td>
	
	
	<td>';

	if($i == (count($dados_espec) -1 )){
		echo '

		<form method="post">
		<input type="hidden" id="id_prescricao"  name="id_prescricao" value="'.$id_prescricao.'">

		<button id="'.$id_prescricao.'" name="btn-excluir-prescricao" style="background: none; color: inherit; border: none; padding: 0; font: inherit;	cursor: pointer; outline: inherit;"><i class="far fa-trash-alt text-danger"></i></button>

		</form>';

	}

	echo '
	
	</td>
	
	</tr>


	
	';

	

}

echo  '
</tbody>
</table> ';




?>





<!--AJAX para exclusão de dados -->
<script type="text/javascript">
	$(document).ready(function(){
		var pag = "<?=$pagina?>";
		var idpresc = "<?=$id_prescricao?>";
		$('#' + idpresc).click(function(event){
			event.preventDefault();
			
			$.ajax({
				url: pag + "/excluir-receita.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function(mensagem){

					
					$('#btn-pesquisar').click();
					document.getElementById('item').value = document.getElementById('num_item').value;
					document.getElementById('remedio').focus();

				},
				
			})
		})
	})
</script>