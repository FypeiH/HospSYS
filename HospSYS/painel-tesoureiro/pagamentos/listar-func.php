<?php 

require_once("../../conexao.php");

$cargo = $_REQUEST['cargo'];



$res = $pdo->query("SELECT * from funcionarios where cargo = '$cargo' order by nome asc");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);

for ($i=0; $i < count($dados); $i++) { 
	foreach ($dados[$i] as $key => $value) {
	}

	$sub_categorias_post[] = array(
		'id'	=> $dados[$i]['id'],
		'nome' => $dados[$i]['nome']
	);

	
	
}


echo(json_encode($sub_categorias_post));

?>
