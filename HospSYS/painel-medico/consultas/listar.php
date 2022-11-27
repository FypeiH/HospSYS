<?php 

require_once("../../conexao.php");
$pagina = 'consultas';
@session_start();

$txtpesquisar = @$_POST['txtpesquisar'];


echo '
<table class="table table-sm mt-3">
<thead class="thead-light">
<tr>
<th scope="col">Paciente</th>
<th scope="col">Hora</th>
<th scope="col">Atendimento</th>
<th scope="col">Status</th>
<th scope="col">Relatórios</th>


<th scope="col">Ações</th>
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
  $res = $pdo->query("SELECT * from consultas where data = curDate() and medico = '$id_med' order by hora asc LIMIT @$limite, @$itens_por_pagina");
}
else
{
  $txtpesquisar = @$_POST['txtpesquisar'];
  $res = $pdo->query("SELECT * from consultas where data = '$txtpesquisar' and medico = '$id_med' order by hora asc");

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


  <td><a style="text-decoration: none; color: white;" href="index.php?acao='.$pagina.'&funcao=editar&id='.$paciente.'">'.$nome_paciente.'<i class="fas fa-clipboard-list ml-1"></i></a></td>
  <td>'.$hora.'</td>
  <td>'.@$descricao_atend.'</td>
  <td>'.$status.'</td>
  <td>';

if($atestado == null)
{

  echo '<a href="index.php?acao='.$pagina.'&funcao=atestado&id='.$id.'"><i class="fas fa-file-medical text-warning mr-1" title="Gerar Atestado"></i></a>';

}

  echo '<a href="index.php?acao='.$pagina.'&funcao=receita&id='.$id.'"><i class="fas fa-file-medical-alt text-info mr-1" title="Gerar Receita"></i></a>
	    <a href="index.php?acao='.$pagina.'&funcao=prescricao&id='.$id.'"><i class="fas fa-file-powerpoint text-light" title="Gerar Prescrição"></i></a>
  
  </td>

  <td>';

  if($status == 'a Aguardar')
  {
    echo '
  <a href="index.php?acao='.$pagina.'&funcao=aconsultar&id='.$id.'"><i class="fas fa-hourglass-half text-light" title="Status a Consultar"></i></a>
  <a href="index.php?acao='.$pagina.'&funcao=achamar&id='.$id.'"><i class="fas fa-volume-up text-light" title="Status a Chamar"></i></a>
  </td>
  </tr>';
  }
  if($status == 'a Consultar')
  {
    echo '
  <a href="index.php?acao='.$pagina.'&funcao=finalizar&id='.$id.'"><i class="fas fa-check-circle text-success" title="Finalizar"></i></a>
  </td>
  </tr>
  ';
  }


}

echo  '
</tbody>
</table> ';


?>