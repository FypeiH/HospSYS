<?php 
  @session_start();
  include_once "../config.php";
  include_once "../conexao.php";
?>


  <div class="wrapper_chat">
    <section class="chat-area">
      <header>
        <?php 
          $user_id = $_GET['id'];
          $sql = $pdo->query("SELECT * FROM utilizadores WHERE id = $user_id");
          $sql->execute();

          $res_count = $pdo->prepare("SELECT FOUND_ROWS()"); 
          $res_count->execute();
          $row_count = $res_count->fetchColumn();

          if($row_count > 0){
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
          }else{
            header("location: users.php");
          }
        ?>
        <a href="index.php?acao=chat" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="../img/fotos-perfil/<?php echo $row[0]['foto']; ?>" alt="">
        <div class="details">
          <span><?php echo $row[0]['nome']?></span>
          <p><?php echo @$row[0]['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Escreva uma mensagem..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </div>
    </section>
  </div>

  <script src="javascript/chat.js"></script>