<?php
	include('../classes/DB.class.php');
	//Adicionando amigo
	if(''<>$_GET['ac']){
		if($_GET['ac']=='convite'){
			$e_meu_amigo=DB::getConn()->prepare("SELECT * FROM `membros` WHERE (de=? AND para=?) LIMIT 1");
			$e_meu_amigo->execute(array($_GET['de'],$_GET['para']));
			
			if($e_meu_amigo->rowCount()==0){
			$convite=DB::getConn()->prepare('INSERT INTO `membros` SET `de`=?, `para`=?');
			$convite->execute(array($_GET['de'],$_GET['para']));
			header('location: ../inst.php?cid='.$_GET['para'].'');
			}
		}
		//Removendo Pedido de Amizade
		//Removendo Amigo		
		if($_GET['ac']=='remover'){
			$e_meu_amigo=DB::getConn()->prepare("SELECT * FROM `membros` WHERE (de=? AND para=?) LIMIT 1");
			$e_meu_amigo->execute(array($_GET['de'],$_GET['para']));
			if($e_meu_amigo->rowCount()==1){
			$convite=DB::getConn()->prepare('DELETE FROM `membros` WHERE (de=? AND para=?)');
			$convite->execute(array($_GET['de'],$_GET['para']));
			header('location: ../inst.php?cid='.$_GET['para'].'');
			}
		}
		
		if($_GET['ac']=='aceitar'){
			$e_meu_amigo=DB::getConn()->prepare("UPDATE `membros` SET `status`=1 WHERE (de=? AND para=?)");
			$e_meu_amigo->execute(array($_GET['de'],$_GET['para']));
			header('location: ../notificacoes.php');
	
		}
		}
?>