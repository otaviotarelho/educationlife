<?php 
		include('../classes/DB.class.php');
		$id=$_GET['id'];
		$usermaster=$_GET['user'];
		extract($_POST);
		if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST'){
		  $update=DB::getConn()->prepare("UPDATE instituicao SET nome=?, descricao=?, nivel=? WHERE id=? and usermaster=?");
		  if($update->execute(array($nome, $descricao, $nivel,$id,$usermaster))){
			  header("location: ../dados.php?&status=31");
		  }else{
			  header("location: ../dados.php?status=30");
		  }
		}
?>