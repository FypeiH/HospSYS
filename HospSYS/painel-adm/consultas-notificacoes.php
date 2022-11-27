<?php 


		$res_1 = $pdo->query("SELECT * from remedios where stock <= '$nivel_stock'");
		$dados_1 = $res_1->fetchAll(PDO::FETCH_ASSOC);
		$valor_1 = count($dados_1);
		if($valor_1 > 0){
			$itens_1 = 1;
		}
		else
		{
			$itens_1 = 0;
		}


		$res_2 = $pdo->query("SELECT * from contas_receber where vencimento = curDate() and forma_pagamento is null");
		$dados_2 = $res_2->fetchAll(PDO::FETCH_ASSOC);
		$valor_2 = count($dados_2);
		if($valor_2 > 0){
			$itens_2 = 1;
		}
		else
		{
			$itens_2 = 0;
		}


		$res_3 = $pdo->query("SELECT * from contas_pagar where vencimento = curDate() and pago != 'Sim'");
		$dados_3 = $res_3->fetchAll(PDO::FETCH_ASSOC);
		$valor_3 = count($dados_3);
		if($valor_3 > 0){
			$itens_3 = 1;
		}
		else
		{
			$itens_3 = 0;
		}


		$res_4 = $pdo->query("SELECT * from consultas where data = curDate() and hora < curTime() and status = 'a Aguardar'");
		$dados_4 = $res_4->fetchAll(PDO::FETCH_ASSOC);
		$valor_4 = count($dados_4);
		if($valor_4 > 0){
			$itens_4 = 1;
		}
		else
		{
			$itens_4 = 0;
		}


		$total_notificacoes = $itens_1 + $itens_2 + $itens_3 + $itens_4;


 ?>