<?php 
		include('../classes/DB.class.php');
		$id_autor=$_GET['autor'];		
        $deletCom=$_GET['id'];
		$id_user=$_GET['user'];
		$deletFrom=$_GET['post'];
		if(isset($id_autor) and isset($deletCom) and isset($id_user) and isset($deletFrom)){
		$delet=DB::getConn()->prepare('DELETE FROM postagem WHERE id=? and de=?');
        $delet->execute(array($deletCom, $id_autor));
		header('location: ../comupdates.php?iduser='.$id_user.'&idpostagem='.$deletFrom.'');
		}
		else{
			header('location: ../');
		}
        
		?>
