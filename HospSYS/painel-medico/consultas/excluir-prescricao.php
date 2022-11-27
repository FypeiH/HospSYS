<?php 

require_once("../../conexao.php");
$id = $_POST['id_prescricao'];



$res = $pdo->query("DELETE from prescricao where id = '$id'");


?>