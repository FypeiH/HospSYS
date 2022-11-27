<?php 
  @session_start();
  include_once "../config.php";
  include_once "../conexao.php";
?>

  <div class="wrapper_chat">
    <section class="users">
      <header>
        <div class="content">
          <?php 

          $id = $_SESSION['id_utilizador'];

            $sql = $pdo->query("SELECT * FROM utilizadores WHERE id = $id");
            $sql->execute();

            $res_count = $pdo->prepare("SELECT FOUND_ROWS()"); 
            $res_count->execute();
            $row_count = $res_count->fetchColumn();
    
            if($row_count > 0){
              $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            }
          ?>
          <img src="../img/fotos-perfil/<?php echo $row[0]['foto']; ?>" alt="">
          <div class="details">
            <span><?php echo $row[0]['nome']?></span>
            <p><?php echo @$row[0]['status']; ?></p>
          </div>
        </div>
      </header>
      <div class="search">
        <span class="text">Escolha um utilizador para conversar</span>
        <input type="text" placeholder="Pesquise um nome...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
            

      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

