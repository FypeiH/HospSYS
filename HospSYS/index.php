<?php 

require_once("config.php");
include 'includes/install.php';
require_once("conexao.php");
require_once "controllerUserData.php";


//Verificar se existe registo default na tabela chamadas e se não existir criar

$res_chamadas = $pdo->query("SELECT * from chamadas");
	$dados_chamadas = $res_chamadas->fetchAll(PDO::FETCH_ASSOC);
	$total_chamadas = count($dados_chamadas);
	if($total_chamadas == 0){
		$res_insert = $pdo->query("INSERT into chamadas (id, paciente, consultorio, status) values ('1', '1', '0', 'a Aguardar')");
	}

 //Verificar se existe o registo default na tabela utilizadores e se não existir criar

 $res_utilizadores = $pdo->query("SELECT * from utilizadores");
 $dados_utilizadores = $res_utilizadores->fetchAll(PDO::FETCH_ASSOC);
 $total_utilizadores = count($dados_utilizadores);

 if($total_utilizadores == 0){
     $res_insert = $pdo->query("INSERT into utilizadores (nome, email, nif, cc, telefone, data_nascimento, data_entrada, cedula, especialidade, consultorio, password, nivel, foto, code, status, estado_conta) values ('HospSYSAdmin', 'hospsys@gmail.com', '000.000.000', '00000', '(+000) 000000000', '0000-00-00', '0000-00-00', NULL, NULL, NULL, '25d55ad283aa400af464c76d713c07ad', 'Admin', 'sem-foto.jpg', 0, 'Offline', 'Ativo')");
 }   

?>


<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>HospSYS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="CSS/footer.css">

	<!--Referência para o Favicon -->
	<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
	<link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">


	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="index.php" method="POST" autocomplete="">

				<div class="logo">
				<img src="img/logo.jpg" alt="HospSYS">
				</div>
                    <h2 class="text-center">HospSYS Login</h2>
                    <p class="text-center">Entre com o seu email e password.</p>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="link forget-pass text-left"><a href="forgot-password.php">Esqueceu-se da password?</a></div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Login">
                    </div>
                    <div class="link login-link text-center">Não está registado? <a href="signup.php">Registe-se agora</a></div>
                </form>
            </div>
        </div>
    </div>
    
    <?php include "footers/footer.php"; ?>
</body>
</html>