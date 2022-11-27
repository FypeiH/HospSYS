<?php 
session_start();
require "conexao.php";
$email = "";
$nome = "";
$errors = array();

//if user signup button
if(isset($_POST['signup'])){

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $nif =  $_POST['nif'];
    $telefone =  $_POST['telefone'];
    $cc =  $_POST['cc'];
    $data_nascimento =  $_POST['data_nascimento'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    
    if($password !== $cpassword){
        $errors['password'] = "As passwords não coincidem!";
    }
    
    $email_check = "SELECT * FROM utilizadores WHERE email = '$email'";
    $res = $pdo->prepare($email_check);
    $res->execute();

    $res = $pdo->prepare("SELECT FOUND_ROWS()"); 
    $res->execute();
    $row_count = $res->fetchColumn();
    
    if($row_count > 0){
        $errors['email'] = "O email que inseriu já existe!";
    }
    if(count($errors) === 0){
        
        $encpass = md5($password);
        $code = rand(999999, 111111);
        $estado_conta = "Inativo";
        $nivel = "Paciente";
        $status = "Offline";
        $foto = "sem-foto.png";

        $insert_data = "INSERT INTO utilizadores (nome, email, nif, cc, telefone, data_nascimento, password, nivel, foto, code, status, estado_conta)
                        values('$nome', '$email', '$nif', '$cc', '$telefone', '$data_nascimento', '$encpass', '$nivel', '$foto', '$code', '$status', '$estado_conta')";
        $data_check = $pdo-> prepare($insert_data);
        $data_check->execute();

        if($data_check){
            $subject = "Código de Verificação de Email";
            
            $sender = "From: HospSYS <pippo.a.bravo@gmail.com>\r\n";
            $sender .= "MIME-Version: 1.0\r\n";
            $sender .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            $message = '<html lang="pt-pt" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
            <head>
                <meta charset="utf-8"> <!-- utf-8 works for most cases -->
                <meta name="viewport" content="width=device-width"> 
                <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
                <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
                <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->
            
               
            
            
            </head>
            
            <body width="100%" style="font-weight: 400; font-size: 15px; line-height: 1.8;
                color: rgba(0,0,0,.4);margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
                <center style="width: 100%; background-color: #f1f1f1;">
                <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all;">
                  &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                </div>
                <div style="max-width: 600px; margin: 0 auto;" class="email-container">
                    <!-- BEGIN BODY -->
                  <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto; border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important;">
                      <tr>
                      <td valign="top" style="padding: 1em 2.5em 0 2.5em; background: #ffffff;">
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                              <tr>
                                  <td style="text-align: center; margin: 0;">
                                  <img src="https://hospsyss.000webhostapp.com/img/logohorizontal.png" alt="" style="width: 200px; max-width: 200px; height: auto; margin: auto; display: block; ">
                                  </td>
                              </tr>
                          </table>
                      </td>
                      </tr><!-- end tr -->
                      <tr>
                      <td valign="middle" style="padding: 3em 0 0em 0; background: #ffffff; position: relative; z-index: 0;">
                        <img src="https://cdn.dribbble.com/users/940008/screenshots/3903521/untitled-3-01.jpg" alt="" style="width: 600px; max-width: 600px; height: auto; margin: auto; display: block; ">
                      </td>
                      </tr><!-- end tr -->
                            <tr>
                      <td valign="middle" style="padding: 2em 0 4em 0; background: #ffffff; position: relative; z-index: 0;">
                        <table style="border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important;">
                            <tr>
                                <td>
                                    <div style="padding: 0 2.5em; text-align: center; color: rgba(0,0,0,.3);">
                                        <h2 style="	color: #000000;	margin-top: 0; font-weight: 400; color: #000; font-size: 35px; margin-bottom: 0; font-weight: 400; line-height: 1.4;">Bem-vindo ao HospSYS!</h2>
                                        <h3 style="	color: #000000;	margin-top: 0; font-weight: 400; font-size: 19px; font-weight: 300;">Por favor, verifique o seu email!</h3>
                                        <h1 style="	color: #000000;	margin-top: 0;	font-weight: 400;">Código OTP</h1>
                                        <p></p>
                                        <div style="position: relative; left: 50%; transform: translate(-50%, -50%); margin:45px 0 25px;">
                                        <div style="background: #edebeb; padding: 10px 15px; border-radius: 5px; letter-spacing: 4px;">
                                        <h2 style="	color: #000000;	margin-top: 0; font-weight: 400;  color: #000; font-size: 40px; margin-bottom: 0; font-weight: 400; line-height: 1.4;">'.$code.'</h2>
                                        </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                      </td>
                      </tr><!-- end tr -->
                  <!-- 1 Column Text + Button : END -->
                  </table>
                  <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto; border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important;">
                      <tr>
                      <td valign="middle" style="background: #fafafa; padding:2.5em; border-top: 1px solid rgba(0,0,0,.05); color: rgba(0,0,0,.5);">
                        <table style="border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important;" >
                    <tr>
                      <td style="text-align: center; background: #fafafa;">
                        <p>Quer aceder sistema HospSYS? <a href="#" style="color: rgba(0,0,0,.8); text-decoration: none;">Aceda Aqui!</a></p>
                      </td>
                    </tr>
                  </table>
            
                </div>
              </center>
            </body>
            </html>';
            
            if(mail($email, $subject, $message, $sender)){
                $info = "Nós mandámos um código de verificação para o seu email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            }else{
                $errors['otp-error'] = "Falha ao enviar o código!";
            }
        }else{
            $errors['db-error'] = "Falha ao inserir os registos na base de dados!";
        }
    }

}

    //if user click verification code submit button
    if(isset($_POST['check'])){
        
        
        $_SESSION['info'] = "";
        $otp_code = $_POST['otp'];

        $check_code = "SELECT * FROM utilizadores WHERE code = $otp_code";
        $code_res = $pdo->prepare($check_code);
        $code_res->execute();

        $count_res = $pdo->prepare("SELECT FOUND_ROWS()"); 
        $count_res->execute();
        $row_count =$count_res->fetchColumn();
        
        
        if($row_count > 0){
            $fetch_data = $code_res->fetchAll(PDO::FETCH_ASSOC);
            $fetch_code = $fetch_data[0]['code'];
            $_SESSION['id_utilizador'] = $fetch_data[0]['id'];
	        $_SESSION['nome_utilizador'] = $fetch_data[0]['nome'];
	        $_SESSION['email_utilizador'] = $fetch_data[0]['email'];
	        $_SESSION['nivel_utilizador'] = $fetch_data[0]['nivel'];
            $_SESSION['estado_utilizador'] = $fetch_data[0]['estado_conta'];
            $code = 0;
            $estado_conta = 'Ativo';
            $update_otp = "UPDATE utilizadores SET code = $code, estado_conta = '$estado_conta' WHERE code = $fetch_code";
            $update_res = $pdo->prepare($update_otp);
            $update_res->execute();
            if($update_res){
                header('location: autenticar.php');
                exit();
            }else{
                $errors['otp-error'] = "Falha ao atualizar o código!";
            }
        }else{
            $errors['otp-error'] = "Inseriu o código errado!";
        }
    }

    //if user click login button
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $check_email = "SELECT * FROM utilizadores WHERE email = '$email'";
        $res = $pdo->prepare($check_email);
        $res->execute();

        $res_count = $pdo->prepare("SELECT FOUND_ROWS()"); 
        $res_count->execute();
        $row_count = $res_count->fetchColumn();

        if($row_count > 0){
            
            $fetch = $res->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['id_utilizador'] = $fetch[0]['id'];
	        $_SESSION['nome_utilizador'] = $fetch[0]['nome'];
	        $_SESSION['email_utilizador'] = $fetch[0]['email'];
	        $_SESSION['nivel_utilizador'] = $fetch[0]['nivel'];
            $_SESSION['estado_utilizador'] = $fetch[0]['estado_conta'];
            $_SESSION['code'] = $fetch[0]['code'];

            $fetch_pass = $fetch[0]['password'];
            if(md5($password) == $fetch_pass){
                $_SESSION['email'] = $email;
                $estado_conta = $fetch[0]['estado_conta'];
                if($_SESSION['code'] == 0 && $estado_conta == 'Ativo'){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                  header('location: autenticar.php');
                }
                if($_SESSION['code'] == 0 && $estado_conta == 'Inativo'){
                    header('location: index.php');
                }
                if($_SESSION['code'] != 0 ){
                    $info = "Ainda não verificou o email - $email";
                    $_SESSION['info'] = $info;
                    header('location: user-otp.php');
                }
            }else{
                $errors['email'] = "Email ou password incorretos!";
            }
        }else{
            $errors['email'] = "Ainda não se registou no sistema! Clique no link abaixo.";
        }
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        
        
        $email = $_POST['email'];
        $check_email = "SELECT * FROM utilizadores WHERE email='$email'";
        $run_sql = $pdo->prepare($check_email);
        $run_sql->execute();

        $res_count = $pdo->prepare("SELECT FOUND_ROWS()"); 
        $res_count->execute();
        $row_count = $res_count->fetchColumn();


        if($row_count > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE utilizadores SET code = $code WHERE email = '$email'";
            $run_query =  $pdo->prepare($insert_code);
            $run_query->execute();

            if($run_query){
                
                $subject = "Código de Redefinição de Password";
                $sender = "From: HospSYS <pippo.a.bravo@gmail.com>\r\n";
                $sender .= "MIME-Version: 1.0\r\n";
                $sender .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                $message = '<html lang="pt-pt" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
            <head>
                <meta charset="utf-8"> <!-- utf-8 works for most cases -->
                <meta name="viewport" content="width=device-width"> 
                <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
                <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
                <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->
            
               
            
            
            </head>
            
            <body width="100%" style="font-weight: 400; font-size: 15px; line-height: 1.8;
                color: rgba(0,0,0,.4);margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
                <center style="width: 100%; background-color: #f1f1f1;">
                <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all;">
                  &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
                </div>
                <div style="max-width: 600px; margin: 0 auto;" class="email-container">
                    <!-- BEGIN BODY -->
                  <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto; border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important;">
                      <tr>
                      <td valign="top" style="padding: 1em 2.5em 0 2.5em; background: #ffffff;">
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                              <tr>
                                  <td style="text-align: center; margin: 0;">
                                  <img src="https://hospsyss.000webhostapp.com/img/logohorizontal.png" style="width: 200px; max-width: 200px; height: auto; margin: auto; display: block; ">
                                  </td>
                              </tr>
                          </table>
                      </td>
                      </tr><!-- end tr -->
                      <tr>
                      <td valign="middle" style="padding: 3em 0 0em 0; background: #ffffff; position: relative; z-index: 0;">
                        <img src="https://www.paymentsjournal.com/wp-content/uploads/2020/09/forgot-password-concept-illustration_114360-1123.jpg" alt="" style="width: 600px; max-width: 600px; height: auto; margin: auto; display: block; ">
                      </td>
                      </tr><!-- end tr -->
                            <tr>
                      <td valign="middle" style="padding: 2em 0 4em 0; background: #ffffff; position: relative; z-index: 0;">
                        <table style="border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important;">
                            <tr>
                                <td>
                                    <div style="padding: 0 2.5em; text-align: center; color: rgba(0,0,0,.3);">
                                        <h2 style="	color: #000000;	margin-top: 0; font-weight: 400; color: #000; font-size: 35px; margin-bottom: 0; font-weight: 400; line-height: 1.4;">Redefinição de Password</h2>
                                        <h3 style="	color: #000000;	margin-top: 0; font-weight: 400; font-size: 19px; font-weight: 300;">Por favor, redefina a sua password!</h3>
                                        <h1 style="	color: #000000;	margin-top: 0;	font-weight: 400;">Código OTP</h1>
                                        <p></p>
                                        <div style="position: relative; left: 50%; transform: translate(-50%, -50%); margin:45px 0 25px;">
                                        <div style="background: #edebeb; padding: 10px 15px; border-radius: 5px; letter-spacing: 4px;">
                                        <h2 style="	color: #000000;	margin-top: 0; font-weight: 400;  color: #000; font-size: 40px; margin-bottom: 0; font-weight: 400; line-height: 1.4;">'.$code.'</h2>
                                        </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                      </td>
                      </tr><!-- end tr -->
                  <!-- 1 Column Text + Button : END -->
                  </table>
                  <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto; border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important;">
                      <tr>
                      <td valign="middle" style="background: #fafafa; padding:2.5em; border-top: 1px solid rgba(0,0,0,.05); color: rgba(0,0,0,.5);">
                        <table style="border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important;" >
                    <tr>
                      <td style="text-align: center; background: #fafafa;">
                          <p>Quer aceder sistema HospSYS? <a href="#" style="color: rgba(0,0,0,.8); text-decoration: none;">Aceda Aqui!</a></p>
                      </td>
                    </tr>
                  </table>
            
                </div>
              </center>
            </body>
            </html>';
                if(mail($email, $subject, $message, $sender)){
                    $info = "Nós mandámos um otp de redefinição de password para o seu email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Falha ao enviar o código!";
                }
            }else{
                $errors['db-error'] = "Algo deu errado!";
            }
        }else{
            $errors['email'] = "Este email não existe no sistema!";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        
        
        $_SESSION['info'] = "";
        $otp_code = $_POST['otp'];
        $check_code = "SELECT * FROM utilizadores WHERE code = $otp_code";
        $code_res =  $pdo->prepare($check_code);
        $code_res->execute();

        $res_count = $pdo->prepare("SELECT FOUND_ROWS()"); 
        $res_count->execute();
        $row_count = $res_count->fetchColumn();



        if($row_count > 0){
            $fetch_data = $code_res->fetchAll(PDO::FETCH_ASSOC);
            $email = $fetch_data[0]['email'];
            $_SESSION['email'] = $email;
            $info = "Por favor crie uma password que não use em nenhum site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "Digitou o código errado!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        
        if($password !== $cpassword){
            $errors['password'] = "As password não coincidem!";
        }else{
            
            
            $code = 0;
            $email = $_SESSION['email'];
            $encpass = md5($password);
           
            $update_pass = "UPDATE utilizadores SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = $pdo->prepare($update_pass);
            $run_query->execute();


            if($run_query){
                $info = "A sua password foi mudada com sucesso. Agora você consegue aceder com a nova password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Falha ao mudar a sua password!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: index.php');
    }
?>