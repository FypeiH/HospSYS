<?php 

require_once("../../conexao.php");
$pagina = 'historico';

@session_start();

$id_utilizador = $_SESSION['id_utilizador'];



$txtpesquisar = '';


echo '
<table class="table table-sm mt-3 tabelas">
<thead class="thead-light">
<tr>
<th scope="col">Atendimento</th>
<th scope="col">Data</th>
<th scope="col">Hora</th>
<th scope="col">Médico</th>
<th scope="col">Valor</th>
<th scope="col">Pagamento Efetuado</th>

</tr>
</thead>
<tbody>';

$itens_por_pagina = 10;

//Buscar a página atual
$pagina_pag = intval(@$_POST['pag']);
    
$limite = $pagina_pag * $itens_por_pagina;

//Caminho da paginação
$caminho_pag = 'index.php?acao='.$pagina.'&';

if($txtpesquisar == '')
{
  $res = $pdo->query("SELECT * from consultas where paciente = $id_utilizador and status = 'Finalizada' order by data, hora asc LIMIT $limite, $itens_por_pagina");
}

$dados = $res->fetchAll(PDO::FETCH_ASSOC);


//Totalizar os Registos para a Paginação 
$res_todos = $pdo->query("SELECT * from consultas where paciente = $id_utilizador and status = 'Finalizada'");
$dados_total = $res_todos->fetchAll(PDO::FETCH_ASSOC);
$num_total = count($dados_total);

//Definir o Total de Páginas
$num_paginas = ceil($num_total/$itens_por_pagina);



for ($i=0; $i < count($dados); $i++) { 
  foreach ($dados[$i] as $key => $value) {
  }

  $id = $dados[$i]['id']; 
  $data = $dados[$i]['data'];
  $data2 = implode('/', array_reverse(explode('-', $data))); 
  $hora = $dados[$i]['hora'];
  $tipo_atendimento = $dados[$i]['tipo_atendimento'];
  $medico = $dados[$i]['medico'];
  $valor = $dados[$i]['valor'];
  $estado_pagamento = $dados[$i]['estado_pagamento'];


  //Buscar o nome do medico

  $res_medico = $pdo->query("SELECT * from utilizadores where nivel = 'Médico' and id = '$medico'");
  $dados_medico = $res_medico->fetchAll(PDO::FETCH_ASSOC);
  $linhas = count($dados_medico);


  if($linhas > 0)
  {

    $nome_medico = $dados_medico[0]['nome']; 

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


  <td>'.@$descricao_atend.'</td>
  <td>'.$data2.'</td>
  <td>'.$hora.'</td>
  <td>'.@$nome_medico.'</td>
  <td>'.$valor.'€</td>
  <td>'.$estado_pagamento.'</td>

  </tr>';

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