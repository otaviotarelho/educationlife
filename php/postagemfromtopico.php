<?php 
		include('../classes/DB.class.php');
		$deletPost=$_GET['id'];
        $deletFrom=$_GET['topico'];
        $deletCom=$_GET['cid'];
		$delet=DB::getConn()->prepare('DELETE FROM comentario WHERE id=? and topico=?');
        $delet->execute(array($deletPost, $deletFrom));
		header('location: ../topico.php?cid='.$deletCom.'&topico='.$deletFrom.'');

?>
