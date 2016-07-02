<?php
	include('../classes/DB.class.php');
	extract($_POST);
	$id=$_GET['id'];
	$alterar=DB::getConn()->prepare("UPDATE `usuarios` SET nome=?, sobrenome=?, nascimento=? WHERE id=?");
	if($alterar->execute(array($nome,$sobrenome,$nascimento,$id))){
		$status=1;
		header("location: ../dados.php?status=".$status."");
	}else{
	  	$status=2;
		header("location: ../dados.php?status=".$status."");
	}

?>