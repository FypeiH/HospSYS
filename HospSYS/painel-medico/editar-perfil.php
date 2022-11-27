<?php 

@session_start();

$pagina = 'editar-perfil'; 

$id_utilizador = $_SESSION['id_utilizador'];

//Pesquisar os dados do registo a ser editado

$resultado = $pdo->query("SELECT * from utilizadores where id = '$id_utilizador'");

$dados = $resultado->fetchAll(PDO::FETCH_ASSOC);

$nome = $dados[0]['nome'];
$especialidade = $dados[0]['especialidade'];
$cedula = $dados[0]['cedula'];
$nif = $dados[0]['nif'];
$cc = $dados[0]['cc'];
$telefone = $dados[0]['telefone'];
$email = $dados[0]['email'];
$data_nascimento = $dados[0]['data_nascimento'];
$data_entrada = $dados[0]['data_entrada'];
$password = $dados[0]['password'];

?>

<link rel="stylesheet" href="../CSS/editar-perfil.css">


<div class="wrapper bg-white">
  <h4 class="pb-4 border-bottom">Definições da Conta</h4>
  <div class="d-flex align-items-start py-3 border-bottom"> <img src="../img/fotos-perfil/<?php echo $foto?>" class="img" alt="">
    <form id="form" method=POST enctype="multipart/form-data" action="editar-perfil/editar.php">

      <input type="hidden" id="id" name="id" value="<?php echo @$id_utilizador ?>">
      <input type="hidden" id="campo_antigo" name="campo_antigo" value="<?php echo @$nif ?>">
      <input type="hidden" id="password_antiga" name="password_antiga" value="<?php echo @$password ?>">
      <input type="hidden" id="data_entrada" name="data_entrada" value="<?php echo @$data_entrada ?>">

      <div class="pl-sm-4 pl-2" id="img-section"> 
        <b>Foto de Perfil</b>
        <p>Tipo de ficheiros aceites .png, .jpg. Menos de 1MB</p>
        <div class="custom-file">
          <input type="file" class="custom-file-input btn-info" name="foto" id="foto">
          <label class="custom-file-label" for="foto">Escolha um ficheiro</label>
        </div>
      </div>
    </div>
    <div class="py-2">
      <div class="row py-2">
        <div class="col-md-6"> 
          <label for="nome">Nome Completo</label> 
          <input type="text" class="bg-light form-control" id="nome" placeholder="Nome" name="nome" value="<?php echo $nome ?>">
        </div>
        <div class="col-md-6"> 
          <label for="data_nascimento">Data de Nascimento</label> 
          <input type="date" class="bg-light form-control" id="data_nascimento" name="data_nascimento" value="<?php echo $data_nascimento ?>">
        </div>
      </div>
      
      <div class="row py-2">
      <div class="col-md-6"> 
          <label for="especialidade">Especialidade</label> 
      <select class="bg-light form-control" id="especialidade" name="especialidade">
      <?php 
      
      $res_espec = $pdo->query("SELECT * from especialidades where id = '$especialidade'");
                  $dados_espec = $res_espec->fetchAll(PDO::FETCH_ASSOC);

                  for ($i=0; $i < count($dados_espec); $i++) { 
                    foreach ($dados_espec[$i] as $key => $value) {
                    }

                    $id_espec = $dados_espec[$i]['id']; 
                    $nome_espec = $dados_espec[$i]['nome'];

                  }

                  echo '<option value="'.$id_espec.'">'.$nome_espec.'</option>';

                
                //Trazer todos os registo de especialidades

                $res = $pdo->query("SELECT * from especialidades order by nome asc");
                $dados = $res->fetchAll(PDO::FETCH_ASSOC);

                for ($i=0; $i < count($dados); $i++) { 
                  foreach ($dados[$i] as $key => $value) {
                  }

                  $id = $dados[$i]['id']; 
                  $nome = $dados[$i]['nome'];

                  if($nome_espec != $nome){

                    echo '<option value="'.$id.'">'.$nome.'</option>';

                  }

                }

      ?>
      </select>
      </div>
      <div class="col-md-6"> 
          <label for="cedula">Cédula</label> 
          <input type="text" class="bg-light form-control" id="cedula" placeholder="Cédula" name="cedula" value="<?php echo $cedula ?>" >
        </div>
      </div>

      <div class="row py-2">
        <div class="col-md-6 pt-md-0 pt-3"> 
          <label for="nif">NIF</label> 
          <input type="text" class="bg-light form-control" id="nif" placeholder="NIF" name="nif" value="<?php echo $nif ?>" disabled>
        </div>
        <div class="col-md-6 pt-md-0 pt-3"> 
          <label for="cc">Cartão de Cidadão</label> 
          <input type="text" class="bg-light form-control" id="cc" placeholder="Cartão de Cidadão" name="cc" value="<?php echo $cc ?>" disabled>
        </div>
      </div>

      <div class="row py-2">
        <div class="col-md-6 pt-md-0 pt-3"> 
          <label for="email">Email</label> 
          <input type="text" class="bg-light form-control" id="email" placeholder="Email" name="email" value="<?php echo $email ?>">
        </div>
        <div class="col-md-6 pt-md-0 pt-3"> 
          <label for="telefone">Telefone</label> 
          <input type="text" class="bg-light form-control" id="telefone" placeholder="Telefone" name="telefone" value="<?php echo $telefone ?>">
        </div>
      </div>

      <div class="row py-2">
        <div class="col-md-6"> 
          <label for="password">Password</label> 
          <input type="password" class="bg-light form-control" id="password" placeholder="Password" name="password" value="">
        </div>
        <div class="col-md-6 pt-md-0 pt-3"> 
          <label for="confirmar_password">Confirmar Password</label> 
          <input type="password" class="bg-light form-control" id="confirmar_password" name="confirmar_password" placeholder="Confirmar Password">
        </div>
      </div>


      <div class="py-3 pb-4 border-bottom"> 
        <button type="submit" id="Editar" class="btn btn-info mr-3">Salvar Alterações</button>
        <a href="index.php"><button type="button" id="btn-fechar" class="btn btn-secondary border">Cancelar</button></a>
      </div>
    </form>

</div>
</div>



    <!-- Mascaras -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <script src="../JS/mascaras.js"></script>


    <!-- Script para mudar o nome da foto no <p></p> -->

    <script>
      $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });
    </script>