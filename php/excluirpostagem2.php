<?php	
			include('../classes/DB.class.php');
			$deletFrom=$_GET['post'];
			$id_user=$_GET['user'];
            if(isset($deletFrom) and isset($id_user)){
			$deletarpostagem=DB::getConn()->prepare('DELETE FROM updates WHERE id=? and por=?');
			if($deletarpostagem->execute(array($deletFrom, $id_user))){
			$deletarcomentarios=DB::getConn()->prepare('DELETE FROM postagem WHERE onde=?');
			$deletarcomentarios->execute(array($deletFrom));
			header('location: ../');
			}
            else{
            header('location: ../');
            }
			}
?>