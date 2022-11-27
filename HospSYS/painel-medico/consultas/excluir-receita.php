<?php 

require_once("../../conexao.php");
$id = $_POST['id_prescricao'];



$res = $pdo->query("DELETE from receitas where id = '$id'");


?>