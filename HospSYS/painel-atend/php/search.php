<?php
    session_start();
    include_once "../../config.php";
    include_once "../../conexao.php";

    $outgoing_id = $_SESSION['id_utilizador'];
    $searchTerm = $_POST['searchTerm'];

    $sql = "SELECT * FROM utilizadores WHERE NOT id = {$outgoing_id} AND (nome LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = $pdo->query($sql);
    $row = $query->fetchAll(PDO::FETCH_ASSOC);


    if(count($row) > 0){
        include_once "data.php";
    }else{
        $output .= 'Nenhum utilizador encontrado.';
    }
    echo $output;
?>