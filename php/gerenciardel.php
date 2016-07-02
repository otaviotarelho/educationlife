<?php 
	include('../classes/DB.class.php');
	if(isset($_GET['id']) and isset($_GET['user']) and isset($_GET['del']) ){
		$verificacao=DB::getConn()->prepare("SELECT * FROM instituicao where id=?  and usermaster=?");
		$verificacao->execute(array($_GET['id'],$_GET['user']));
		if($verificacao->rowCount()==1){
				$del=DB::getConn()->prepare("DELETE FROM `membros` WHERE para=? and de=? ");
				if($del->execute(array($_GET['id'], $_GET['del']))){
					header("location: ../gerenciar.php?id=".$_GET['de']."&user=".$_GET['user']."&status=1");
				}else{
					header("location: ../gerenciar.php?id=".$_GET['de']."&user=".$_GET['user']."&status=0");
				}
		}
		else{
			header("location: ../inst.php?cid=".$_GET['de']."");
		}
		//end of the main if
		}
		else{
			header("location: ./");
		}

?>