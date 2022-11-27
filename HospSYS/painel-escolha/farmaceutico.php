<?php 

require_once("../conexao.php");
require_once("../config.php");

?>



<html lang="pt-pt" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>HospSYS</title>
    <link rel="stylesheet" href="../CSS/painel_escolha1.css">

	<!--Referência para o Favicon -->
	<link rel="shortcut icon" href="../img/favicon/favicon.ico" type="image/x-icon">
	<link rel="icon" href="../img/favicon/favicon.ico" type="image/x-icon">

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="wrapper">
	<a href="../painel-farmacia/index.php" style="text-decoration: none;">
        <div class="box">
        <div class="front-face">
          <div class="icon"><i class="fas fa-pills"></i></div>
          <span>Painel Farmacêutico</span>
        </div>
        <div class="back-face">
          <span>Painel Farmacêutico</span>
          <p style="text-align: center;">Clique aqui para aceder ao Painel de Farmacêutico</p>
        </div>
      </div>
    </a>
	<a href="../painel-paciente/index.php" style="text-decoration: none;">
      <div class="box">
        <div class="front-face">
          <div class="icon"><i class="fas fa-user-injured"></i></div>
          <span>Painel Paciente</span>
        </div>
        <div class="back-face">
          <span>Painel Paciente</span>
          <p style="text-align: center;">Clique aqui para aceder ao Painel de Paciente</p>
        </div>
      </div>
    </a>

    </div>
  </body>
</html>
