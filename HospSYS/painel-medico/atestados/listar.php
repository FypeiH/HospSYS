<?php 

require_once("../../conexao.php");
$pagina = 'atestados';
@session_start();

$txtpesquisar = @$_POST['txtpesquisar'];


echo '
<table class="table table-sm mt-3">
<thead class="thead-light">
<tr>
<th scope="col">Paciente</th>
<th scope="col">Hora</th>
<th scope="col">Atendimento</th>
<th scope="col">Atestado</th>
</tr>
</thead>
<tbody>';


$id_medico = $_SESSION['id_utilizador'];

$res_med = $pdo->query("SELECT * from utilizadores where id = '$id_medico'");
$dados_med = $res_med->fetchAll(PDO::FETCH_ASSOC);

for ($i=0; $i < count($dados_med); $i++) { 
  foreach ($dados_med[$i] as $key => $value) {
  }

  $id_med = $dados_med[$i]['id']; 
  $consultorio = $dados_med[$i]['consultorio'];
  $nome_med = $dados_med[$i]['nome'];

}



if($txtpesquisar == '')
{
  $res = $pdo->query("SELECT * from consultas where data = curDate() and medico = '$id_med' and atestado != '' order by hora asc LIMIT @$limite, @$itens_por_pagina");
}
else
{
  $txtpesquisar = @$_POST['txtpesquisar'];
  $res = $pdo->query("SELECT * from consultas where data = '$txtpesquisar' and medico = '$id_med' and atestado != '' order by hora asc");

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


  echo '
  <tr>


  <td>'.$nome_paciente.'</td>
  <td>'.$hora.'</td>
  <td>'.@$descricao_atend.'</td>
  <td>
      <a href="rel/rel_atestado_class.php?id='.$id.'" target="_blank"><i class="fas fa-file-medical text-warning mr-1" title="Gerar Atestado"></i></a
  
  </td>

  </tr>  ';
 


}

echo  '
</tbody>
</table> ';


?>