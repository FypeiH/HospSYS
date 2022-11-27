<?php  

require_once("config.php");

date_default_timezone_set('Europe/Lisbon');

try {
	$pdo = new PDO("mysql:dbname=$base_dados;host=$host", "$utilizadorbd", "$passbd");

	//conexao mysql para o backup
	$conn = mysqli_connect($host, $utilizadorbd, $passbd, $base_dados);
} catch (Exception $e) {
	echo "Erro na ligação com a base de dados.". $e;
}

?>