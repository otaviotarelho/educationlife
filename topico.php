<?php include('includes/header.php');?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>EducationLife - Visualiza&ccedil;&atilde;o de T&oacute;pico</title>
<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 8]>
<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
<script src="js/nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
</head>

<body>  <?php include('includes/toolbar.php'); ?>
       	<div id="topico">
    		<?php 	
					$verificacao2=DB::getConn()->prepare('SELECT * FROM `instituicao` WHERE `usermaster`=? LIMIT 1');
	$verificacao2->execute(array($iddasessao));
					$resultver2=$verificacao2->fetch(PDO::FETCH_ASSOC);
					$inst=$_GET['cid'];
					$topicoget=$_GET['topico'];
					if(isset($_GET['cid']) and isset($_GET['topico']) ){
						
					}
					else{
						if(isset($_GET['cid'])){
							header('location: inst.php?$cid=$inst');
						}
					}			
                	$topico=DB::getConn()->prepare('SELECT * FROM topicos WHERE `id`=? and `id_inst`=? AND (tipo=0 OR tipo=1) LIMIT 1');
					$topico->execute(array($_GET['topico'],$inst));
					if($topico->rowCount()==0){
						header('location: inst.php?$cid=$inst');			
					}		
					else{
						$result=$topico->fetch(PDO::FETCH_ASSOC);
						$usuarioautor=$result['id_autor'];
						$autor=DB::getConn()->prepare('SELECT * FROM usuarios WHERE `id`=? LIMIT 1');
						$autor->execute(array($usuarioautor));
						$resultautor=$autor->fetch(PDO::FETCH_ASSOC);
						echo'
						 <table width="95%" border="0">
     					 <tr>
       					 <td width="17%">&nbsp;</td>
      					  <td width="83%"><h1>'.$result['nome'].'</h1></td>
     					 </tr>
      					<tr>
       					 <td>&nbsp;</td>
      					  <td>'.$result['conteudo'].'
    						<br>
							<br></td>
    					  </tr>
     					 <tr>
     					   <td  bgcolor="#FCF1E4" align="center" valign="middle"><img src="uploads/usuario/'.$resultautor['imagem'].'" width="53" height="50"></td>
     					   <td  bgcolor="#FCF1E4" align="center" valign="middle">Autor: '.$resultautor['nome'].' | Data: '.$result['adicionado'].''; 
						   if($iddasessao==$resultver2['usermaster'] or $iddasessao==$result['id_autor']){
							   echo ' | <a href="php/postagemtopico.php?cid='.$inst.'&id='.$topicoget.'">Deletar</a>';
						   }
						   else{}  
						    echo' </td>
    					  </tr>
    					</table>
						<br>
					';}
				
            ?>
    	</div>
        <?php 
		if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST'){
			$coment=$_POST['coment'];
			if(isset($_SESSION['last_request'])&& $_SESSION['last_request']==$coment){
			}else{
			$_SESSION['last_request']=$coment;
			$INSERINDO=DB::getConn()->prepare('INSERT INTO comentario SET topico=?,inst=?, id_autor=?, comentario=?');
			$INSERINDO->execute(array($topicoget,$inst,$iddasessao,$coment));}
		}
	
	?>
<div id="comment">
        <?php 
			$comentario=DB::getConn()->prepare('SELECT * FROM comentario WHERE `topico`=? and `inst`=?');
			$comentario->execute(array($topicoget,$inst));
			if($comentario->rowCount()==0){
				echo"<p>Nenhum Comentário, Seja o primeiro a comentar!</p><br />";
			}
			else{
				echo'<table width="80%" border="0">
';
				while($rest=$comentario->fetch(PDO::FETCH_ASSOC)){
					$comentarioautor=DB::getConn()->prepare('SELECT * FROM usuarios WHERE `id`=?');
					$comentarioautor->execute(array($rest['id_autor']));
					$restcomentautor=$comentarioautor->fetch(PDO::FETCH_ASSOC);
					  echo'
					 
  <tr>
    <td width="5%" height="42" valign="top"> <img src="uploads/usuario/'.$restcomentautor['imagem'].'" width="35" height="36" /></td>
    <td width="95%" style="font-size:13px; font-family:Verdana, Geneva, sans-serif;" valign="top">'.$restcomentautor['nome'].' disse: '.$rest['comentario'].'<br />
    <div style="color:#CCC;"> Data: '.$rest['adicionado'].'';
		if($iddasessao==$rest['id_autor'] or $iddasessao==$result['id_autor'] or $iddasessao==$resultver2['usermaster']){
			$topicoid=$rest['id'];
			echo' | <a href="php/postagemfromtopico.php?cid='.$inst.'&topico='.$topicoget.'&id='.$topicoid.'">Deletar</a></div>';
		}else{echo'</div>';}
	
	echo'<br><hr align="center" width="80%" size="1" color=#CCC></td>
  </tr>			 
  ';
				}
				echo'</table>
				
				<br/><br/>';}
		?>
        </div>
<div id="newcomment">
  <?php 
  	$verificacao=DB::getConn()->prepare('SELECT * FROM membros WHERE `de`=? and `para`=?');
	$verificacao->execute(array($iddasessao,$inst));
	if($verificacao->rowCount()==0){
	if($verificacao2->rowCount()==0){
		echo"<p>Você necessita ser membro dessa instituição para ter a permissão de comentar.</p>";
	}
	else{
		echo'<table width="300" border="0">
  <tr>
    <td align="left" valign="top"><img src="uploads/usuario/'. $user_imagem.'" width="66" height="62"></td>
   <td align="left" valign="top"><form action="" method="post" enctype="multipart/form-data" name="comentario"> 
        <textarea name="coment" cols="50" rows="5" ></textarea>
        <input name="enviar" type="submit" value="enviar">
      
    </form></td>
  </tr>
</table>';
	}
	}else{
		echo'<table width="300" border="0">
  <tr>
    <td align="left" valign="top"><img src="uploads/usuario/'.$user_imagem.'" width="66" height="62"></td>
    <td align="left" valign="top"><form action="" method="post"  name="comentario">
    <textarea name="coment" cols="50" rows="5"></textarea>
    <input name="enviar" type="submit" value="enviar">
      
    </form></td>
  </tr>
</table>';
	} 
  ?>
  <br />  
</div>
<br />
<br />
</body>
</html>