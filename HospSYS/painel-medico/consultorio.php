<?php 

$pagina = 'consultorio'; 
$dia_atual = date('Y-m-d');
@session_start();

?>


<!-- Código do botão "Editar" -->

<?php 

  //Trazer o consultório atendido pelo médico

  $id_medico = $_SESSION['id_utilizador'];

  $res_med = $pdo->query("SELECT * from utilizadores where nivel = 'Médico' and id = '$id_medico'");
  $dados_med = $res_med->fetchAll(PDO::FETCH_ASSOC);

  for ($i=0; $i < count($dados_med); $i++) { 
    foreach ($dados_med[$i] as $key => $value) {
    }

    $id_med = $dados_med[$i]['id']; 
    $consultorio = $dados_med[$i]['consultorio'];

  }

  ?>

  <div class="modal fade" id="modal-editar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Consultório</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST">

            <input type="hidden" id="id" name="id" value="<?php echo @$id_med ?>">

            <div class="form-group">
             <label for="exampleFormControlSelect1">Consultório</label>
             <input class="form-control" type="text" name="consultorio" id="consultorio" value="<?php echo @$consultorio ?>"
            </div>

          <div id="mensagem" class="">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="btn-fechar-editar" name="btn-fechar-editar" data-dismiss="modal">Cancelar</button>
          <button type="button" id="btn-editar" name="btn-editar" class="btn btn-info">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>$('#modal-editar').modal("show")</script>



<!-- AJAX para editar os dados-->

<script type="text/javascript">

  $(document).ready(function(){

    var pag = "<?=$pagina?>";

    $('#btn-editar').click(function(event) {
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