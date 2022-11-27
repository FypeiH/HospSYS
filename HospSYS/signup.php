<?php require_once "controllerUserData.php"; ?>
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
    <div class="container" style="max-width: 5000px ">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="signup.php" method="POST" autocomplete="">
                
                <div class="logo">
				<img src="img/logo.jpg" alt="HospSYS">
				</div>
                    <h2 class="text-center">HospSYS Signup</h2>
                    <p class="text-center">Registe-se no nosso sistema.</p>
                    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="row">

                    <div class="col-md-6">
                    <div class="form-group">
                        <input class="form-control" type="text" name="nome" placeholder="Nome Completo" required value="<?php echo @$nome ?>">
                    </div>
                    </div>

                    <div class="col-md-6">
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email" required value="<?php echo @$email ?>">
                    </div>
                </div>

                </div>
                
                <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <input class="form-control" type="text" name="nif" id="nif" placeholder="NIF" required value="<?php echo @$nif ?>">
                    </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                        <input class="form-control" type="text" name="telefone" id="telefone" placeholder="Telefone" required value="<?php echo @$telefone ?>">
                    </div>
                </div>

                </div>
                
                <div class="row">

                <div class="col-md-6">
                    
                    <div class="form-group">
                        <input class="form-control" type="text" name="cc" id="cc" placeholder="Cartão de Cidadão" required value="<?php echo @$cc ?>">
                    </div>
                    
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" onfocus="(this.type = 'date')" onfocusout="(this.type = 'text')" placeholder="Data de Nascimento" class="form-control" id="data_nascimento" name="data_nascimento" required>
                    </div>
                </div>
                

                </div>

                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirmar password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="signup" value="Signup">
                    </div>
                    <div class="link login-link text-center">Já está registado? <a href="index.php">Clique aqui</a></div>
                </form>
            </div>
        </div>
    </div>
    
    <?php include "footers/footer.php"; ?>
</body>

</html>

<!-- Mascaras -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script src="JS/mascaras.js"></script>