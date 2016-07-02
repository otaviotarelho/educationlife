<?php
	include('../classes/DB.class.php');
	//Adicionando amigo
	if(''<>$_GET['ac']){
		if($_GET['ac']=='convite'){
			$e_meu_amigo=DB::getConn()->prepare("SELECT * FROM `amizade` WHERE (de=? AND para=?) or (para=? AND de=?) LIMIT 1");
			$e_meu_amigo->execute(array($_GET['de'],$_GET['para'],$_GET['de'],$_GET['para']));
			
			if($e_meu_amigo->rowCount()==0){
			$convite=DB::getConn()->prepare('INSERT INTO `amizade` SET `de`=?, `para`=?');
			$convite->execute(array($_GET['de'],$_GET['para']));
			header('location: ../perfil.php?uid='.$_GET['para'].'');
			}
		}
		//Removendo Pedido de Amizade
		//Removendo Amigo		
		if($_GET['ac']=='remover'){
			$e_meu_amigo=DB::getConn()->prepare("SELECT * FROM `amizade` WHERE (de=? AND para=?) or (para=? AND de=?) LIMIT 1");
			$e_meu_amigo->execute(array($_GET['de'],$_GET['para'],$_GET['de'],$_GET['para']));
			if($e_meu_amigo->rowCount()==1){
			$convite=DB::getConn()->prepare('DELETE FROM `amizade` WHERE (de=? AND para=?) or (para=? AND de=?)');
			$convite->execute(array($_GET['de'],$_GET['para'],$_GET['de'],$_GET['para']));
			header('location: ../perfil.php?uid='.$_GET['para'].'');
			}
		}
		
		if($_GET['ac']=='aceitar'){
			$e_meu_amigo=DB::getConn()->prepare("UPDATE `amizade` SET `status`=1 WHERE (de=? AND para=?)");
			$e_meu_amigo->execute(array($_GET['de'],$_GET['para']));
			header('location: ../notificacoes.php');
	
		}
		}
?>