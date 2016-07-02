<?php 
			include('../classes/DB.class.php');
			$update=$_POST['updatetext'];
			$verificar = DB::getConn()->prepare("INSERT INTO `updates` SET `por`=?, `text`=?, `type`=?");
			$verificar->execute(array($iddasessao,$update,'0'));
			
?>