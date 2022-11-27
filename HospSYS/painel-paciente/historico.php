<?php 

$pagina = 'historico'; 
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