<?php 
    session_start();

    include_once "../../config.php";
    include_once "../../conexao.php";
        
        
        $outgoing_id = $_SESSION['id_utilizador'];
        $incoming_id = $_POST['incoming_id'];
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN utilizadores ON utilizadores.id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        
        $query =  $pdo->query($sql);
        $row = $query->fetchAll(PDO::FETCH_ASSOC);


        if(count($row) > 0){
            
            $i=0;

            for($i=0; $i < count($row); $i++)
            {
            foreach($row[$i] as $key => $value) 
            {  
            }  
                if($row[$i]['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row[$i]['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming">
                                <img src="../img/fotos-perfil/'.$row[$i]['foto'].'" alt="">
                                <div class="details">
                                    <p>'. $row[$i]['msg'] .'</p>
                                </div>
                                </div>';
                }

                $i=$i++;
            }
        }else{
            $output .= '<div class="text">Nenhuma mensagem disponível. No momento em que enviar uma mensagem, irá aparecer aqui.</div>';
        }
        echo $output;

?>