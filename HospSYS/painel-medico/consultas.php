<?php 

$pagina = 'consultas'; 
$dia_atual = date('Y-m-d');


?>

<div class="row botao-novo">
  <div class="col-md-12">
    

  </div>
</div>

<div class="row mt-4">
  <div class="col-md-6 col-sm-12">
    <div class="float-left">


  </div>
</div>


<div class="col-md-6 col-sm-12">
  <div class="float-right mr-4">

   <form id="frm" class="form-inline my-2 my-lg-0" method=POST>

     <input type="hidden" id="pag" name="pag" value="<?php echo @$_GET['pagina'] ?>">

     <input type="hidden" id="id_consulta"  name="id_consulta" value="<?php echo @$_GET['id'] ?>">

     <input type="hidden" id="itens" name="itens" value="<?php echo @$itens_por_pagina; ?>">
     
     <input class="form-control form-control-sm mr-sm-2 " type="date" name="txtpesquisar" id="txtpesquisar" value="<?php echo $dia_atual ?>">
     <button class="btn btn-info btn-sm my-2 my-sm-0 " name="btn-pesquisar" id="btn-pesquisar"><i class="fas fa-search"></i></button>

   </form>

 </div>
</div>

</div>

<div id="listar">


</div>


    <!-- Código do botão "Finalizar" -->

    <?php 

    if(@$_GET['funcao'] == 'finalizar')
    {  
      $id = $_GET['id'];
      ?>

      <div class="modal" id="modal-finalizar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Finalizar Consulta</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Deseja mesmo finalizar esta consulta?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="btn-fechar-finalizar" name="btn-fechar-finalizar" data-dismiss="modal">Cancelar</button>
              <form method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo @$id ?>">
                <button type="button" id="btn-finalizar" name="btn-finalizar" class="btn btn-success">Finalizar</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>


    <script>$('#modal-finalizar').modal("show")</script>


    <!-- Código do botão "a Consultar" -->

    <?php 

    if(@$_GET['funcao'] == 'aconsultar')
    {  
      $id = $_GET['id'];
      ?>

      <div class="modal" id="modal-aconsultar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">A Consultar Consulta</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Deseja mesmo colocar esta consulta a decorrer?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="btn-fechar-aconsultar" name="btn-fechar-aconsultar" data-dismiss="modal">Cancelar</button>
              <form method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo @$id ?>">
                <button type="button" id="btn-aconsultar" name="btn-aconsultar" class="btn btn-info">A Consultar</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>


    <script>$('#modal-aconsultar').modal("show")</script>


<!-- Código do botão "a Chamar" -->

<?php 

if(@$_GET['funcao'] == 'achamar')
{  
  $id = $_GET['id'];
  ?>

  <div class="modal" id="modal-achamar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">A Chamar Paciente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Deseja mesmo chamar este paciente?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="btn-fechar-achamar" name="btn-fechar-achamar" data-dismiss="modal">Cancelar</button>
          <form method="POST">
            <input type="hidden" id="id" name="id" value="<?php echo @$id ?>">
            <button type="button" id="btn-achamar" name="btn-achamar" class="btn btn-info">Chamar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php } ?>


<script>$('#modal-achamar').modal("show")</script>

    
    <!-- Código da Modal Relatório de Atestado -->

    <?php 

    if(@$_GET['funcao'] == 'atestado')
    {  
      $id = $_GET['id'];
      ?>

      <div class="modal" id="modal-atestado" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Gerar Atestado</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="POST">
            <div class="form-group">
                <label for="exampleFormControlInput1">Dias</label>
                <input class="form-control form-control-sm mr-sm-2 " type="number" name="dias" id="dias" required>
            </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="btn-fechar-atestado" name="btn-fechar-atestado" data-dismiss="modal">Cancelar</button>
              
                <input type="hidden" id="id" name="id" value="<?php echo @$id ?>">
                <button type="button" id="btn-atestado" name="btn-atestado" class="btn btn-info">Gerar</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>


    <script>$('#modal-atestado').modal("show")</script>


    <!-- Código da Modal Relatório de Prescrição -->

    <?php 

    if(@$_GET['funcao'] == 'prescricao')
    {  
      $id = $_GET['id'];
      ?>

      <div class="modal" id="modal-prescricao" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Gerar Prescrição</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form method="POST">

            <div class="row">
              <div class="col-md-2">
              
                <div class="form-group">
                  <label for="exampleFormControlInput1">Item</label>
                  <input class="form-control form-control-sm mr-sm-2 " type="number"  name="item" id="item" required readonly>
                </div>
              
              </div>

              <div class="col-md-10">
              
                <div class="form-group">
                  <label for="exampleFormControlInput1">Remédio</label>
                  <input class="form-control form-control-sm mr-sm-2 " type="text" name="remedio" id="remedio" required>
                </div>
              </div>
            </div>

            <div id="listar-prescricao">

            </div>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="btn-fechar-prescricao" name="btn-fechar-prescricao" data-dismiss="modal">Cancelar</button>
              
                <input type="hidden" id="id_consulta"  name="id_consulta" value="<?php echo @$id ?>" required>

                <button type="button" id="btn-prescricao" name="btn-prescricao" class="btn btn-info">Gerar</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>


    <script>$('#modal-prescricao').modal("show")</script>


<!--Chamada da Modal da Receita -->
<?php 
if(@$_GET['funcao'] == 'receita'){ 
	$id = $_GET['id'];
	?>

	<div class="modal" id="modal-receita" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Gerar Receita</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<form method="post">
						<input class="form-control form-control-sm mr-sm-2" type="hidden" name="dataFinalPost" id="dataFinalPost">



						

						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label for="exampleFormControlInput1">Item</label>
									<input class="form-control form-control-sm mr-sm-2" type="number" name="item_receita" id="item_receita"  required>
								</div>
							</div>

							<div class="col-md-10">
								<div class="form-group">
									<label for="exampleFormControlInput1">Remédio</label>
									<input class="form-control form-control-sm mr-sm-2" type="text" name="remedio" id="remedio" required>
								</div>
							</div>
						</div>

						
					

						
						<div id="listar-receita">

						</div>


						<div id="mensagem" class="">

					</div>
						


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-fechar">Cancelar</button>

						<input type="hidden" id="id_consulta"  name="id_consulta" value="<?php echo @$id ?>" required>

						<button type="button" id="btn-receita" name="btn-receita" class="btn btn-info">Salvar</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	
<?php } ?>


<script>$('#modal-receita').modal("show");</script>


<?php
    if(@$_GET['funcao'] == 'editar' && @$item_paginado == '')
    {  
      $id_registo = $_GET['id'];
?>
<!-- Modal -->

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">

          <?php 

            //Pesquisar os dados do registo

            $resultado = $pdo->query("SELECT * from utilizadores where id = '$id_registo'");

            $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

            $nome = $dados[0]['nome'];
            $nif = $dados[0]['nif'];
            $cc = $dados[0]['cc'];
            $telefone = $dados[0]['telefone'];
            $email = $dados[0]['email'];
            $data_nascimento = $dados[0]['data_nascimento'];
            $obs = $dados[0]['obs'];


            
            echo 'Dados de Pacientes';
          

          ?>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method=POST>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">

                <input type="hidden" id="id" name="id" value="<?php echo @$id_registo ?>">

                <input type="hidden" id="campo_antigo" name="campo_antigo" value="<?php echo @$nif ?>">

                <label for="exampleFormControlInput1">Nome</label>
                <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" value="<?php echo @$nome ?>" disabled>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlInput1">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo @$data_nascimento ?>" disabled>
              </div>
            </div>
            
          </div>

          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlInput1">NIF</label>
                <input type="text" class="form-control" id="nif" placeholder="NIF" name="nif" value="<?php echo @$nif ?>" disabled>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlInput1">Cartão de Cidadão</label>
                <input type="text" class="form-control" id="cc" placeholder="Cartão de Cidadão" name="cc" value="<?php echo @$cc ?>" disabled>
              </div>
            </div>
        </div>


        <div class="row">
      
          <div class="col-md-6">
             <div class="form-group">
              <label for="exampleFormControlInput1">Telefone</label>
              <input type="text" class="form-control" id="telefone" placeholder="Telefone" name="telefone" value="<?php echo @$telefone ?>" disabled>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleFormControlInput1">Email</label>
              <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo @$email ?>" disabled>
            </div>
          </div>
    </div>

    


    <div class="form-group">
      <label for="exampleFormControlInput1">Observações</label>
      <textarea class="form-control" id="obs" name="obs" maxlenght="350"><?php echo @$obs; ?></textarea>
    </div>

  </div>


  <div id="mensagem" class="col-md-12 text-center mt-3">

  </div>

  <div class="modal-footer">

    <button id="btn-fechar" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>


    <button type="submit" name="Guardar" id="Guardar" class="btn btn-info">Guardar</button>


  </div>
</form>
</div>
</div>
</div>

<?php } ?>

<script>$('#modal').modal("show")</script>


<!-- AJAX para listar os dados-->

<script type="text/javascript">

  $(document).ready(function(){

    var pag = "<?=$pagina?>";

    $.ajax({
      url: pag + "/listar.php",
      method: "POST",
      data: $('#frm').serialize(),
      dataType: "html",
      success: function(result){

        $('#listar').html(result)

      },
    })

  })

</script>


<!-- AJAX para listar os dados pesquisados-->

<script type="text/javascript">

  $(document).ready(function(){

    var pag = "<?=$pagina?>";

    $('#btn-pesquisar').click(function(event) {
      event.preventDefault(); //Não permite a atualização da página

      $.ajax({
        url: pag + "/listar.php",
        method: "POST",
        data: $('form').serialize(),
        dataType: "html",
        success: function(result){

          $('#listar').html(result)

        },
      })

    })

  })

</script>


<!-- AJAX para filtro direto dos dados pesquisados-->

<script type="text/javascript">
  $('#txtpesquisar').change(function(){

    $('#btn-pesquisar').click();

  })


</script>


<!-- AJAX para finalizar a consulta-->

<script type="text/javascript">

$(document).ready(function(){

  var pag = "<?=$pagina?>";

  $('#btn-finalizar').click(function(event) {
event.preventDefault(); //Não permite a atualização da página

$.ajax({
  url: pag + "/finalizar.php",
  method: "POST",
  data: $('form').serialize(),
  dataType: "text",
  success: function(mensagem){

    $('#btn-pesquisar').click();

    $('#btn-fechar-finalizar').click();

  },
})
})
})

</script>

<!-- AJAX para a consultar a consulta-->

<script type="text/javascript">

$(document).ready(function(){

  var pag = "<?=$pagina?>";

  $('#btn-aconsultar').click(function(event) {
event.preventDefault(); //Não permite a atualização da página

$.ajax({
  url: pag + "/aconsultar.php",
  method: "POST",
  data: $('form').serialize(),
  dataType: "text",
  success: function(mensagem){

    $('#btn-pesquisar').click();

    $('#btn-fechar-aconsultar').click();

  },
})
})
})

</script>

<!-- AJAX para a consultar a consulta-->

<script type="text/javascript">

$(document).ready(function(){

  var pag = "<?=$pagina?>";

  $('#btn-achamar').click(function(event) {
event.preventDefault(); //Não permite a atualização da página

$.ajax({
  url: pag + "/achamar.php",
  method: "POST",
  data: $('form').serialize(),
  dataType: "text",
  success: function(mensagem){

    $('#btn-pesquisar').click();

    $('#btn-fechar-achamar').click();

  },
})
})
})

</script>

<!-- AJAX para editar os dados-->

<script type="text/javascript">

$(document).ready(function(){

  var pag = "<?=$pagina?>";

  $('#Guardar').click(function(event) {
event.preventDefault(); //Não permite a atualização da página

$.ajax({
  url: pag + "/editar.php",
  method: "POST",
  data: $('form').serialize(),
  dataType: "text",
  success: function(mensagem){

    $('#mensagem').removeClass()

    if(mensagem == 'Editado com Sucesso!')
    {
      $('#mensagem').addClass('mensagem-sucesso')

      $('#btn-pesquisar').click();

      $('#btn-fechar').click();


    }
    else
    {
      $('#mensagem').addClass('mensagem-erro')
    }
    $('#mensagem').text(mensagem)
  },
})
})
})

</script>


<!-- AJAX para lançar os dias do atestado-->

<script type="text/javascript">

$(document).ready(function(){

  var pag = "<?=$pagina?>";

  $('#btn-atestado').click(function(event) {
event.preventDefault(); //Não permite a atualização da página

$.ajax({
  url: pag + "/atestado.php",
  method: "POST",
  data: $('form').serialize(),
  dataType: "text",
  success: function(mensagem){

    $('#mensagem').removeClass()

    if(mensagem == 'Editado com Sucesso!')
    {
      $('#mensagem').addClass('mensagem-sucesso')

      $('#btn-pesquisar').click();

      $('#btn-fechar-atestado').click();


    }
    else
    {
      $('#mensagem').addClass('mensagem-erro')
    }
    $('#mensagem').text(mensagem)
  },
})
})
})

</script>



<!--AJAX para lançar prescrição -->
<script type="text/javascript">
	$(document).ready(function(){
		var pag = "<?=$pagina?>";
		$('#btn-prescricao').click(function(event){
			event.preventDefault();
			
			$.ajax({
				url: pag + "/prescricao.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function(mensagem){

				$('#btn-pesquisar').click();
				document.getElementById('remedio').value = '';
				document.getElementById('item').value = document.getElementById('num_item').value;
				document.getElementById('remedio').focus();

				},
				
			})
		})
	})
</script>






<!--AJAX para listar os dados da prescrição-->
<script type="text/javascript">
	$(document).ready(function(){
		
		var pag = "<?=$pagina?>";

		$.ajax({
			url: pag + "/listar-prescricao.php",
			method: "post",
			data: $('#frm').serialize(),
			dataType: "html",
			success: function(result){
				$('#listar-prescricao').html(result);
				document.getElementById('item').value = document.getElementById('num_item').value;

			},

			
		})
	})
</script>







<!--AJAX para buscar os dados da prescrição-->
<script type="text/javascript">
	$(document).ready(function(){

		var pag = "<?=$pagina?>";
		$('#btn-pesquisar').click(function(event){
			event.preventDefault();	
			
			$.ajax({
				url: pag + "/listar-prescricao.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "html",
				success: function(result){
					$('#listar-prescricao').html(result)
					document.getElementById('item').value = document.getElementById('num_item').value;
				},
				

			})

		})

		
	})
</script>





<!--AJAX para lançar receita -->
<script type="text/javascript">
	$(document).ready(function(){
		var pag = "<?=$pagina?>";
		$('#btn-receita').click(function(event){
			event.preventDefault();
			
			$.ajax({
				url: pag + "/receita.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function(mensagem){

				$('#btn-pesquisar').click();
				document.getElementById('remedio').value = '';
				document.getElementById('item_receita').value = document.getElementById('num_item_receita').value;
				document.getElementById('remedio').focus();

				},
				
			})
		})
	})
</script>






<!--AJAX para listar os dados da receita-->
<script type="text/javascript">
	$(document).ready(function(){
		
		var pag = "<?=$pagina?>";

		$.ajax({
			url: pag + "/listar-receita.php",
			method: "post",
			data: $('#frm').serialize(),
			dataType: "html",
			success: function(result){
				$('#listar-receita').html(result);
				document.getElementById('item_receita').value = document.getElementById('num_item_receita').value;

			},

			
		})
	})
</script>







<!--AJAX para buscar os dados da receita -->
<script type="text/javascript">
	$(document).ready(function(){

		var pag = "<?=$pagina?>";
		$('#btn-pesquisar').click(function(event){
			event.preventDefault();	
			
			$.ajax({
				url: pag + "/listar-receita.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "html",
				success: function(result){
					$('#listar-receita').html(result)
					document.getElementById('item_receita').value = document.getElementById('num_item_receita').value;
				},
				

			})

		})

		
	})
</script>



