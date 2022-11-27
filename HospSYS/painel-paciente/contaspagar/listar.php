<?php 

require_once("../../conexao.php");
$pagina = 'contaspagar';

@session_start();


$id_utilizador = $_SESSION['id_utilizador'];


$txtpesquisar = @$_POST['txtpesquisar'];


echo '
<table class="table table-sm mt-3 tabelas">
<thead class="thead-light">
<tr>
<th scope="col">Descrição</th>
<th scope="col">Valor</th>
<th scope="col">Vencimento</th>

<th scope="col">Confirmação</th>
</tr>
</thead>
<tbody>';


$itens_por_pagina = $_POST['itens'];

//Buscar a página atual
$pagina_pag = intval(@$_POST['pag']);

$limite = $pagina_pag * $itens_por_pagina;

    //Caminho da paginação
$caminho_pag = 'index.php?acao='.$pagina.'&';

if($txtpesquisar == ''){
  $res = $pdo->query("SELECT * from contas_receber inner join consultas on contas_receber.id_consulta = consultas.id where consultas.paciente = $id_utilizador order by contas_receber.id desc LIMIT $limite, $itens_por_pagina");
}else{
  $txtpesquisar = @$_POST['txtpesquisar'];
  $res = $pdo->query("SELECT * from contas_receber inner join consultas on contas_receber.id_consulta = consultas.id where consultas.paciente = $id_utilizador order by contas_receber.id desc");

}

$dados = $res->fetchAll(PDO::FETCH_ASSOC);


  //Totalizar os Registos para a Paginação 
$res_todos = $pdo->query("SELECT * from contas_receber inner join consultas on contas_receber.id_consulta = consultas.id where consultas.paciente = $id_utilizador");
$dados_total = $res_todos->fetchAll(PDO::FETCH_ASSOC);
$num_total = count($dados_total);

    //Definir o Total de Páginas
$num_paginas = ceil($num_total/$itens_por_pagina);


for ($i=0; $i < count($dados); $i++) { 
  foreach ($dados[$i] as $key => $value) {
  }

  $id = $dados[$i]['id']; 
  $descricao = $dados[$i]['descricao'];
  $valor = $dados[$i]['valor'];
  $vencimento = $dados[$i]['vencimento'];
  $forma_pagamento = $dados[$i]['forma_pagamento'];
  $id_consulta = $dados[$i]['id_consulta'];

  $vencimento2 = implode('/', array_reverse(explode('-', $vencimento)));

  if($forma_pagamento == '')
  {
    $forma_pagamento = 'Pendente';
  }


      //Recuperar o nome do Atendimento

  $resultado_desc = $pdo->query("SELECT * from atendimentos where id = '$descricao'");
  $dados_desc = $resultado_desc->fetchAll(PDO::FETCH_ASSOC);
  $atendimento = $dados_desc[0]['descricao'];



  echo '
  <tr>


  <td>'.$atendimento.'</td>
  <td>'.$valor.'€</td>
  <td>'.$vencimento2.'</td>
';

  if($forma_pagamento != 'Pendente')
  {
    echo '
    <td>
    Pago!
    </td>';
  }
  else
  {
   echo '
   <td>
   Pendente
   </td> ';
 }

 echo '</tr>';

}

echo  '
</tbody>
</table> ';


if($txtpesquisar == ''){


  echo '
  <!--Área de Paginação-->

  <nav class="paginacao" aria-label="Page navigation example">
  <ul class="pagination">
  <li class="page-item">
  <a class="btn btn-outline-light btn-sm mr-1" href="'.$caminho_pag.'pagina=0&itens='.$itens_por_pagina.'" aria-label="Previous">
  <span aria-hidden="true">&laquo;</span>
  <span class="sr-only">Previous</span>
  </a>
  </li>';

  for($i=0;$i<$num_paginas;$i++)
  {
    $estilo = "";
    if($pagina_pag == $i)
    {
      $estilo = "active";
    } 

    echo '
    <li class="page-item"><a class="btn btn-outline-light btn-sm mr-1 '.$estilo.'" href="'.$caminho_pag.'pagina='.$i.'&itens='.$itens_por_pagina.'">'.($i+1).'</a></li>';
  }

  echo '
  <li class="page-item">
  <a class="btn btn-outline-light btn-sm" href="'.$caminho_pag.'pagina='.($num_paginas-1).'&itens='.$itens_por_pagina.'" aria-label="Next">
  <span aria-hidden="true">&raquo;</span>
  <span class="sr-only">Next</span>
  </a>
  </li>
  </ul>
  </nav>


  ';

}


?>