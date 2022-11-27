<?php 

require_once("../../conexao.php");
$pagina = 'nivel';

$txtpesquisar = @$_POST['txtpesquisar'];


echo '
<table class="table table-sm mt-3">
  <thead class="thead-light">
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Descrição</th>
      <th scope="col">Stock</th>
    </tr>
  </thead>
  <tbody>';

  $res = $pdo->query("SELECT * from remedios where stock <= '$nivel_stock' order by stock asc");
  
  $dados = $res->fetchAll(PDO::FETCH_ASSOC);


  for ($i=0; $i < count($dados); $i++) { 
      foreach ($dados[$i] as $key => $value) {
      }

      $id = $dados[$i]['id']; 
      $nome = $dados[$i]['nome'];
      $descricao = $dados[$i]['descricao'];
      $stock = $dados[$i]['stock'];
      


echo '
    <tr>

      <td>'.$nome.'</td>
      <td>'.$descricao.'</td>
      <td>'.$stock.'</td>
      
    </tr>';

  }

echo  '
  </tbody>
</table> ';



?>