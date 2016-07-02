<?php 
		include('../classes/DB.class.php');
		$deletPost=$_GET['id'];
        $deletCom=$_GET['cid'];
		$delet=DB::getConn()->prepare('DELETE FROM topicos WHERE id=? and id_inst=?');
        $delet->execute(array($deletPost, $deletCom));
		$deletallpost=DB::getConn()->prepare('DELETE FROM comentario WHERE topico=?');
		$deletallpost->execute(array($deletPost));
		header('location: ../inst.php?cid='.$deletCom.'');

?>
