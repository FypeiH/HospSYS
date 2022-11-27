<?php 

$pagina = 'contaspagar'; 
$dia_atual = date('Y-m-d');

?>

<div class="row botao-novo">
  <div class="col-md-12">

  </div>
</div>

<div class="row mt-4">
  <div class="col-md-6 col-sm-12">
    <div class="float-left">

      <form method = POST>
       <select onChange="submit();" class="form-control-sm" id="exampleFormControlSelect1" name="itens-pagina">

        <?php 

        if(isset($_POST['itens-pagina']))
        {
          $item_paginado = $_POST['itens-pagina'];
        }
        elseif(isset($_GET['itens'])){
          $item_paginado = $_GET['itens'];
        }

        ?>

        <option value="<?php echo @$item_paginado ?>"><?php echo @$item_paginado ?> Registos</option>

        <?php if(@$item_paginado != $opcao1) 
        { ?>
          <option value="<?php echo $opcao1; ?>"><?php echo $opcao1; ?> Registos</option>

        <?php }?>

        <?php if(@$item_paginado != $opcao2) 
        { ?>
          <option value="<?php echo $opcao2; ?>"><?php echo $opcao2; ?> Registos</option>

        <?php }?>

        <?php if(@$item_paginado != $opcao3) 
        { ?>
          <option value="<?php echo $opcao3; ?>"><?php echo $opcao3; ?> Registos</option>

        <?php }?>

      </select>
    </form>


  </div>
</div>

<?php 

  //Definir o número de itens por página

if(isset($_POST['itens-pagina']))
{
  $itens_por_pagina = $_POST['itens-pagina'];
  @$_GET['pagina'] = 0;
}
elseif(isset($_GET['itens']))
{
  $itens_por_pagina = $_GET['itens'];
}
else
{
  $itens_por_pagina = $opcao1;

}

?>

<div class="col-md-6 col-sm-12">
  <div class="float-right mr-4">

   <form id="frm" class="form-inline my-2 my-lg-0" method=POST>

     <input type="hidden" id="pag" name="pag" value="<?php echo @$_GET['pagina'] ?>">

     <input type="hidden" id="itens" name="itens" value="<?php echo @$itens_por_pagina; ?>">

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


