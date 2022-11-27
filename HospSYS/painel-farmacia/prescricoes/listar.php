<?php 

require_once("../../conexao.php");
$pagina = 'prescricoes';
@session_start();

$txtpesquisar = @$_POST['txtpesquisar'];


echo '
<table class="table table-sm mt-3">
<thead class="thead-light">
<tr>
<th scope="col">Paciente</th>
<th scope="col">Médico</th>
<th scope="col">Hora</th>
<th scope="col">Atendimento</th>
<th scope="col">Prescrição</th>
</tr>
</thead>
<tbody>';



if($txtpesquisar == ''){

	$res = $pdo->query("SELECT * from consultas where data = curDate() and prescricao = 'Sim' order by hora asc LIMIT $limite, $itens_por_pagina");

}else{

	$txtpesquisar = @$_POST['txtpesquisar'];
	$res = $pdo->query("SELECT * from consultas where data = '$txtpesquisar' and prescricao = 'Sim' order by hora asc");


}

$dados = $res->fetchAll(PDO::FETCH_ASSOC);


for ($i=0; $i < count($dados); $i++) { 
  foreach ($dados[$i] as $key => $value) {
  }

  $id = $dados[$i]['id']; 
  $paciente = $dados[$i]['paciente'];
  $hora = $dados[$i]['hora'];
  $tipo_atendimento = $dados[$i]['tipo_atendimento'];
  $medico = $dados[$i]['medico'];
  $status = $dados[$i]['status'];
  $atestado = $dados[$i]['atestado'];

  //Buscar o nome do paciente

  $res_paciente = $pdo->query("SELECT * from utilizadores where id = '$paciente'");
  $dados_paciente = $res_paciente->fetchAll(PDO::FETCH_ASSOC);
  $linhas = count($dados_paciente);


  if($linhas > 0)
  {

    $nome_paciente = $dados_paciente[0]['nome']; 

  }


  //Buscar o nome do atendimento

  $res_atend = $pdo->query("SELECT * from atendimentos where id = '$tipo_atendimento'");
  $dados_atend = $res_atend->fetchAll(PDO::FETCH_ASSOC);
  $linhas = count($dados_atend);


  if($linhas > 0)
  {

    $descricao_atend = $dados_atend[0]['descricao']; 

  }

  //Buscar o nome do paciente

  $res_medico = $pdo->query("SELECT * from utilizadores where id = '$medico'");
  $dados_medico = $res_medico->fetchAll(PDO::FETCH_ASSOC);
  $linhas = count($dados_medico);


  if($linhas > 0)
  {

    $nome_medico = $dados_medico[0]['nome']; 

  }


  echo '
  <tr>


  <td>'.$nome_paciente.'</td>
  <td>'.$nome_medico.'</td>
  <td>'.$hora.'</td>
  <td>'.@$descricao_atend.'</td>
  <td>
      <a href="rel/rel_prescricao_class.php?id='.$id.'" target="_blank"><i class="fas fa-file-powerpoint text-light" title="Gerar Prescrição"></i></a> 
  </td>

  </tr>  ';
 


}

echo  '
</tbody>
</table> ';


?>