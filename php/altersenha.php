<?php
	include('../classes/DB.class.php');
	extract($_POST);
	$id=$_GET['id'];
	$senha=sha1($senhaatual);
	$verificacao=DB::getConn()->prepare("SELECT senha FROM `usuarios` WHERE id=?");
	if($verificacao->execute(array($id))){
	if($verificacao->rowCount()==1){
		$verifica=$verificacao->fetch(PDO::FETCH_ASSOC);
		if($senha==$verifica['senha']){
			$senhanova=sha1($novasenha);
			$alterar=DB::getConn()->prepare("UPDATE `usuarios` SET senha=? WHERE id=?");
			if($alterar->execute(array($senhanova,$id))){
			$status=10;
			header("location: ../dados.php?status=".$status."");
	        }else{
	  	    $status=11;
		    header("location: ../dados.php?status=".$status."");
	        }
		}else{
			$status=12;
			header("location: ../dados.php?status=".$status."");
		}
	}else{
		$status=13;
		header("location: ../dados.php?status=".$status."");
	}
	}else{
		$status=0;
		header("location: ../dados.php?status=".$status."");
	}
?>