<?php 

require_once("../../conexao.php");


$nome = $_POST['nome'];
$nif = $_POST['nif'];
$cc = $_POST['cc'];
$cedula = $_POST['cedula'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];
$data_entrada = $_POST['data_entrada'];
$foto = $_POST['foto'];

//Buscar o id do cargo
$resultado_cargo = $pdo->query("SELECT * from cargos where nome = 'Farmacêutico' or nome = 'Farmaceutico' or nome = 'farmacêutico' or nome = 'farmaceutico'");
$dados_cargo = $resultado_cargo->fetchAll(PDO::FETCH_ASSOC);
@$id_cargo = $dados_cargo[0]['id'];


//Script para as fotos na base de dados

$caminho = '../../img/fotos-perfil/' .$_FILES['foto']['name'];

if ($_FILES['foto']['name'] == ""){
	$imagem = "sem-foto.png";
}else{
	$imagem = $_FILES['foto']['name']; 
}

$imagem_temp = $_FILES['foto']['tmp_name']; 
move_uploaded_file($imagem_temp, $caminho);


  //Verificar se o recepcionista existe

$resultado_verificar = $pdo->query("SELECT * from utilizadores where nif = '$nif'");

$dados_verificar = $resultado_verificar->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados_verificar);


if($nome == '')
{
	echo "Preencha o Campo!";
	exit();
}
if($nif == '')
{
	echo "Preencha o Campo!";
	exit();
}


if($linhas == 0)
{

	//Registar na tabela Utilizadores

	$resultado = $pdo->prepare("INSERT into utilizadores (nome, email, nif, cc, telefone, data_nascimento, data_entrada, cedula, especialidade, password, nivel, foto, estado_conta) values (:nome, :email, :nif, :cc, :telefone, :data_nascimento, :data_entrada, :cedula, :especialidade, :password, :nivel, :foto, :estado_conta)");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":email", $email);
	$resultado->bindValue(":nif", $nif);
	$resultado->bindValue(":cc", $cc);
	$resultado->bindValue(":data_nascimento", $data_nascimento);
	$resultado->bindValue(":data_entrada", $data_entrada);
	$resultado->bindValue(":telefone", $telefone);
	$resultado->bindValue(":cedula", $cedula);
	$resultado->bindValue(":especialidade", NULL);

	$nif_sem_pontos = preg_replace('/[^0-9]/', '', $nif);

	$resultado->bindValue(":password",md5($nif_sem_pontos));
	$resultado->bindValue(":nivel", 'Farmacêutico');
	$resultado->bindValue(":foto", $imagem);
	$resultado->bindValue(":estado_conta", 'Ativo');

	$resultado->execute();

	//Registar na tabela Funcionários

		$resultado = $pdo->prepare("INSERT into funcionarios (nome, email, nif, cc, telefone, data_nascimento, data_entrada, cargo) values (:nome, :email, :nif, :cc, :telefone, :data_nascimento, :data_entrada, :cargo)");

	$resultado->bindValue(":nome", $nome);
	$resultado->bindValue(":nif", $nif);
	$resultado->bindValue(":cc", $cc);
	$resultado->bindValue(":data_nascimento", $data_nascimento);
	$resultado->bindValue(":data_entrada", $data_entrada);
	$resultado->bindValue(":telefone", $telefone);
	$resultado->bindValue(":email", $email);;
	$resultado->bindValue(":cargo", $id_cargo);

	$resultado->execute();



	echo "Registado com Sucesso!";

}
else
{
	echo "Este Utilizador Já Existe!";
}


?>