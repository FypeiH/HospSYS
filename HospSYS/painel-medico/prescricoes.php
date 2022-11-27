<?php 

$pagina = 'prescricoes'; 
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

     <input type="hidden" id="itens" name="itens" value="<?php echo @$itens_por_pagina; ?>">
     
     <input class="form-control form-control-sm mr-sm-2 " type="date" name="txtpesquisar" id="txtpesquisar" value="<?php echo $dia_atual ?>">
     <button class="btn btn-info btn-sm my-2 my-sm-0 " name="btn-pesquisar" id="btn-pesquisar"><i class="fas fa-search"></i></button>

   </form>

 </div>
</div>

</div>

<div id="listar">


</div>


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