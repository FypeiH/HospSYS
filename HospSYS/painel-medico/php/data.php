<?php 


$i=0;
$x=0;

for($i=0; $i < count($row); $i++)
{
  foreach($row[$i] as $key => $value) 
  {  
  }        

        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row[$i]['id']}
                OR outgoing_msg_id = {$row[$i]['id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        
        $query2 =  $pdo->query($sql2);
        $row2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        
        
        if(count($row2) > 0){
            $result = $row2[$x]['msg'];
        }else{
            $result ="Nenhuma Mensagem Disponível";
        }
        
        (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
        @($outgoing_id == $row2[$x]['outgoing_msg_id']) ? $you = "Tu: " : $you = "";
        (@$row[$i]['status'] == "Offline") ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row[$i]['id']) ? $hid_me = "hide" : $hid_me = "";

        $output .= '<a href="index.php?acao=chat1&id='. $row[$i]['id'] .'">
                    <div class="content">
                    <img src="../img/fotos-perfil/'. $row[$i]['foto'] .'" alt="">
                    <div class="details">
                        <span>'. $row[$i]['nome'].'</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                    </div>
                    <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                </a>';


        $i=$i++;
        $x=$x++;
    }
?>