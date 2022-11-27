<?php 

$pagina = 'funcionarios'; 

?>

<div class="row botao-novo">
  <div class="col-md-12">
    
    <a id="btn-novo" data-toggle="modal" data-target="#modal"></a>
    <a href="index.php?acao=<?php echo $pagina; ?>&funcao=novo" type="button" class="btn btn-light">Novo Funcionário</a>

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
     
     <input class="form-control form-control-sm mr-sm-2 " type="search" placeholder="Pesquisar Nome" aria-label="Search" name="txtpesquisar" id="txtpesquisar">
     <button class="btn btn-info btn-sm my-2 my-sm-0 " name="<?php echo $pagina; ?>" id="btn-pesquisar"><i class="fas fa-search"></i></button>

   </form>

 </div>
</div>

</div>

<div id="listar">


</div>


<!-- Modal -->

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">

          <?php if (@$_GET['funcao'] == 'editar') {

            $nome_botao = 'Guardar';
            $id_registo = $_GET['id'];

            //Pesquisar os dados do registo a ser editado

            $resultado = $pdo->query("SELECT * from funcionarios where id = '$id_registo'");

            $dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

            $nome = $dados[0]['nome'];
            $nif = $dados[0]['nif'];
            $cc = $dados[0]['cc'];
            $telefone = $dados[0]['telefone'];
            $email = $dados[0]['email'];
            $data_nascimento = $dados[0]['data_nascimento'];
            $data_entrada = $dados[0]['data_entrada'];
            $cargo = $dados[0]['cargo'];


            echo 'Edição de Funcionários';
          } 
          else{$nome_botao = 'Salvar'; echo 'Registo de Funcionários';} 

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

                <label for="exampleFormControlInput1">Nome Completo</label>
                <input type="text" class="form-control" id="nome" placeholder="Nome Completo" name="nome" value="<?php echo @$nome ?>" required>
           </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
               <label for="exampleFormControlSelect1">Cargo</label>
               <select class="form-control" id="" name="cargo">



                <?php 

                //Se exister a edição dos dados, trazer como primeiro registo a cargo do funcionarios

                if (@$_GET['funcao'] == 'editar') {

                  $res_cargo = $pdo->query("SELECT * from cargos where id = '$cargo'");
                  $dados_cargo = $res_cargo->fetchAll(PDO::FETCH_ASSOC);

                  for ($i=0; $i < count($dados_cargo); $i++) { 
                    foreach ($dados_cargo[$i] as $key => $value) {
                    }

                    $id_cargo = $dados_cargo[$i]['id']; 
                    $nome_cargo = $dados_cargo[$i]['nome'];

                  }

                  echo '<option value="'.$id_cargo.'">'.$nome_cargo.'</option>';

                }
                //Trazer todos os registo de especialidades

                $res = $pdo->query("SELECT * from cargos order by nome asc");
                $dados = $res->fetchAll(PDO::FETCH_ASSOC);

                for ($i=0; $i < count($dados); $i++) { 
                  foreach ($dados[$i] as $key => $value) {
                  }

                  $id = $dados[$i]['id']; 
                  $nome = $dados[$i]['nome'];

                  if($nome_cargo != $nome){

                    echo '<option value="'.$id.'">'.$nome.'</option>';

                  }

                } ?>
              </select>
            </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlInput1">NIF</label>
                <input type="text" class="form-control" id="nif" placeholder="NIF" name="nif" value="<?php echo @$nif ?>" <?php if($nome_botao == 'Guardar'){echo"disabled";}else{echo"required";}?>>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlInput1">Cartão de Cidadão</label>
                <input type="text" class="form-control" id="cc" placeholder="Cartão de Cidadão" name="cc" value="<?php echo @$cc ?>" <?php if($nome_botao == 'Guardar'){echo"disabled";}else{echo"required";}?>>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
              <label for="exampleFormControlInput1">Email</label>
              <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo @$email ?>" required>
            </div>
            </div>

            <div class="col-md-6">
             <div class="form-group">
          <label for="exampleFormControlInput1">Telefone</label>
          <input type="text" class="form-control" id="telefone" placeholder="Telefone" name="telefone" value="<?php echo @$telefone ?>" required>
        </div>
          </div>
        </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleFormControlInput1">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo @$data_nascimento ?>" required>
              </div>
            </div>

            <div class="col-md-6">
             <div class="form-group">
              <label for="exampleFormControlInput1">Data de Entrada</label>
              <input type="date" class="form-control" id="data_entrada" name="data_entrada" value="<?php echo @$data_entrada ?>" required>
            </div>
          </div>
        </div>


<div id="mensagem" class="col-md-12 text-center mt-3">

</div>

</div>
<div class="modal-footer">

  <button id="btn-fechar" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>


  <button name="<?php echo $nome_botao ?>" id="<?php echo $nome_botao ?>" class="btn btn-info"><?php echo $nome_botao ?></button>


</div>
</form>
</div>
</div>
</div>


<!-- Código do botão "Novo Funcionário" -->

<?php 

if(@$_GET['funcao'] == 'novo'&& @$item_paginado == '')
  {  ?>
    <script>$('#btn-novo').click();</script>
  <?php } ?>


  <!-- Código do botão "Editar" -->

  <?php 

  if(@$_GET['funcao'] == 'editar' && @$item_paginado == '')
    {  ?>
      <script>$('#btn-novo').click();</script>
    <?php } ?>


    <!-- Código do botão "Excluir" -->

    <?php 

    if(@$_GET['funcao'] == 'excluir' && @$item_paginado == '')
    {  
      $id = $_GET['id'];
      ?>

      <div class="modal" id="modal-excluir" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Excluir Registo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Deseja mesmo excluir este registo?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="btn-fechar-excluir" name="btn-fechar-excluir" data-dismiss="modal">Cancelar</button>
              <form method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo @$id ?>">
                <button type="button" id="btn-excluir" name="btn-excluir" class="btn btn-danger">Excluir</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    <?php } ?>


    <script>$('#modal-excluir').modal("show")</script>



    <!-- Mascaras -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <script src="../JS/mascaras.js"></script>



    <!-- AJAX para inserir os dados-->

    <script type="text/javascript">

      $(document).ready(function(){

        var pag = "<?=$pagina?>";

        $('#Salvar').click(function(event) {
      event.preventDefault(); //Não permite a atualização da página

      $.ajax({
        url: pag + "/inserir.php",
        method: "POST",
        data: $('form').serialize(),
        dataType: "text",
        success: function(mensagem){

          $('#mensagem').removeClass()

          if(mensagem == 'Registado com Sucesso!')
          {
            $('#mensagem').addClass('mensagem-sucesso')

            $('#nome').val('')
            $('#cedula').val('')
            $('#nif').val('')
            $('#telefone').val('')
            $('#email').val('')

            $('#txtpesquisar').val('')
            $('#btn-pesquisar').click();

            //$('#btn-fechar').click();


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
      $('#txtpesquisar').keyup(function(){

        $('#btn-pesquisar').click();

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


            $('#txtpesquisar').val('')
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


    <!-- AJAX para excluir os dados-->

    <script type="text/javascript">

      $(document).ready(function(){

        var pag = "<?=$pagina?>";

        $('#btn-excluir').click(function(event) {
      event.preventDefault(); //Não permite a atualização da página

      $.ajax({
        url: pag + "/excluir.php",
        method: "POST",
        data: $('form').serialize(),
        dataType: "text",
        success: function(mensagem){

          $('#txtpesquisar').val('')
          $('#btn-pesquisar').click();

          $('#btn-fechar-excluir').click();

        },
      })
    })
      })

    </script>