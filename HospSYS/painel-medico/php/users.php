<?php
    @session_start();
    include_once "../../config.php";
    include_once "../../conexao.php";
    
    $outgoing_id = $_SESSION['id_utilizador'];
    
    $sql = "SELECT * FROM utilizadores WHERE NOT id = $outgoing_id AND nivel <> 'Paciente' ORDER BY id DESC";
    $query =  $pdo->query($sql);
    $row = $query->fetchAll(PDO::FETCH_ASSOC);

    
    $output = "";
   
    if(count($row) == 0){
        $output .= "Nenhum utilizador disponível";
    }elseif(count($row) > 0){
        include_once "data.php";
    }
    echo $output;
?>