<?php 
	include('../classes/DB.class.php');
	if(isset($_POST['upload']) and $_POST['upload']=='perfil')
{	
	$image2=$_POST['antiga'];
	$id=$_POST['id'];
	if($image2<>'default.png' and file_exists("../uploads/usuario/".$image2)){
		unlink("../uploads/usuario/".$image2);
	}	
	include('funcoes.php');
	$imagem=$_FILES['image'];
	$nome = $id.sha1($imagem['name']).date('-his').'.jpg';
	$ext = array('image/jpeg','image/pjpeg','image/jpg','image/gif','image/png');
			if(in_array($imagem['type'],$ext)){
			upload($imagem['tmp_name'],$imagem['name'],$nome,700,'../uploads/usuario');
			$update = DB::getConn()->prepare('UPDATE `usuarios` SET `imagem`=? WHERE `id`=?');
			$update->execute(array($nome,$id));
			
			if(file_exists('../uploads/usuario/'.$nome)){
				
				header('Location: ../dados.php?status=1&perfil=CROP');
				exit();
			}
			}else{
				header('Location: ../dados.php?status=40');
			}
}
else if(isset($_POST['upload']) and $_POST['upload']=='instituicao')
{	
	$image2=$_POST['antiga'];
	$id=$_POST['id'];
	if($image2<>'default.png' and file_exists("../uploads/usuario/".$image2)){
		unlink("../uploads/usuario/".$image2);
	}	
	include('funcoes.php');
	$imagem=$_FILES['image'];
	$nome = $id.sha1($imagem['name']).date('-his').'.jpg';
	$ext = array('image/jpeg','image/pjpeg','image/jpg','image/gif','image/png');
			if(in_array($imagem['type'],$ext)){
			upload($imagem['tmp_name'],$imagem['name'],$nome,700,'../uploads/usuario');
			$update = DB::getConn()->prepare('UPDATE `instituicao` SET `imagem`=? WHERE `id`=?');
			$update->execute(array($nome,$id));
			
			if(file_exists('../uploads/usuario/'.$nome)){
				
				header('Location: ../dados.php?status=1&inst=CROP2&cid='.$id.'');
				exit();
			}
			}else{
				header('Location: ../dados.php?status=40');
			}
}
else if(isset($_POST['salvar']) and $_POST['salvar']=='salvar'){
	$img=imagecreatefromjpeg('../uploads/usuario/'.$_POST['imagem']);
	$largura=175;
	$altura=150;
	$nova=imagecreatetruecolor($largura,$altura);
	imagecopyresampled($nova,$img,0,0,$_POST['x'],$_POST['y'],$largura,$altura,$_POST['w'],$_POST['h']);
	imagejpeg($nova,'../uploads/usuario/'.$_POST['imagem'],80);
	header('Location: ../dados.php?status=1');
}else{
header('Location: ../dados.php?status=0');
}

	
?>