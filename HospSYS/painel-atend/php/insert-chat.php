<?php 
    session_start();

    include_once "../../config.php";
    include_once "../../conexao.php";

    
        $outgoing_id = $_SESSION['id_utilizador'];
        $incoming_id = $_POST['incoming_id'];
        $message = $_POST['message'];
        if(!empty($message)){
            $sql = $pdo->query("INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
        }


    
?>