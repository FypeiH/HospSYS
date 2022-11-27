<?php 

require_once("../../conexao.php");
@session_start();

$id = $_POST['id'];

$func = $_SESSION['id_utilizador'];

//Buscar o nif do utilizador logado




$pdo->query("UPDATE contas_pagar set pagamento = curDate(), pago = 'Sim', funcionario = '$func' where id = '$id'");


echo "Editado com Sucesso!";




?>