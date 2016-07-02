<?php include('includes/header.php');?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>EducationLife - Visualiza&ccedil;&atilde;o de Postagens</title>
<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 8]>
<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
</head>

<body>  <?php include('includes/toolbar.php'); ?>
		<?php 	
			    
	   		if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST'){
			$coment=$_POST['coment'];
			$idpostagem=$_GET['idpostagem'];
			if(isset($_SESSION['last_request'])&& $_SESSION['last_request']==$coment){
			}else{
			$_SESSION['last_request']=$coment;
			$INSERINDO=DB::getConn()->prepare('INSERT INTO postagem SET de=?, onde=?, comentario=?');
			$INSERINDO->execute(array($iddasessao,$idpostagem,$coment));}
		}
	
		?>
       	<div id="topico">
        	<?php
				$iduser=$_GET['iduser'];
				$idpostagem=$_GET['idpostagem'];
				if(isset($iduser) and isset($idpostagem)){
					$postagem=DB::getConn()->prepare('SELECT * FROM updates WHERE id=? and por=? LIMIT 1');
					$postagem->execute(array($idpostagem,$iduser));
					if($postagem->rowCount()==0){
						header('location: ./');
					}
					else{
						$resultadopostagem=$postagem->fetch(PDO::FETCH_ASSOC);
						$usuariocriador=DB::getConn()->prepare('SELECT * FROM usuarios WHERE id=?');
						$usuariocriador->execute(array($resultadopostagem['por']));
						$usuariocriador2=$usuariocriador->fetch(PDO::FETCH_ASSOC);
						echo'
						<table width="95%" border="0">
     					 <tr>
       					 <td width="17%">&nbsp;</td>
      					  <td width="83%"><h1>'.$resultadopostagem['text'].'</h1></td>
     					 </tr>
      					 <tr>
     					   <td  bgcolor="#FCF1E4" align="center" valign="middle"><img src="uploads/usuario/'.$usuariocriador2['imagem'].'" width="53" height="50"></td>
     					   <td  bgcolor="#FCF1E4" align="center" valign="middle">Autor: '.$usuariocriador2['nome'].' | Data: '.$resultadopostagem['posted'].'';
						   if($iddasessao==$resultadopostagem['por']){
							   echo' | <a href="php/excluirpostagem2.php?user='.$resultadopostagem['por'].'&post='.$resultadopostagem['id'].'">Deletar</a>';
						   }
						   echo'</td>
    					  </tr>
    					</table>';
					}
				}
				else{
				}
			?>
    	</div>
<div id="comment"><?php
			$comentario=DB::getConn()->prepare('SELECT * FROM postagem WHERE `onde`=?');
			$comentario->execute(array($idpostagem));
			if($comentario->rowCount()==0){
				echo"<p>Nenhum Comentário, Seja o primeiro a comentar!</p><br />";
			}
			else{
				echo'<table width="80%" border="0">
';
				while($rest=$comentario->fetch(PDO::FETCH_ASSOC)){
					$comentarioautor=DB::getConn()->prepare('SELECT * FROM usuarios WHERE `id`=?');
					$comentarioautor->execute(array($rest['de']));
					$restcomentautor=$comentarioautor->fetch(PDO::FETCH_ASSOC);
					  echo'
					 
  <tr>
    <td width="5%" height="42" valign="top"> <img src="uploads/usuario/'.$restcomentautor['imagem'].'" width="35" height="36" /></td>
    <td width="95%" style="font-size:13px; font-family:Verdana, Geneva, sans-serif;" valign="top">'.$restcomentautor['nome'].' disse: '.$rest['comentario'].'<br />
    <div style="color:#CCC;"> Data: '.$rest['posted'].'';
	if($iddasessao==$rest['de'] or $iddasessao==$resultadopostagem['por']){
		echo' | <a href="php/excluirpostagem.php?user='.$resultadopostagem['por'].'&autor='.$restcomentautor['id'].'&id='.$rest['id'].'&post='.$resultadopostagem['id'].'">Deletar</a>';
	}
	echo'</div><br><hr align="center" width="80%" size="1" color=#CCC></td>
  </tr>			 
  ';
				}
				echo'</table>
				
				<br/>';}
		?>
</div>       
<div id="newcomment">
  <?php 
  	$verificacao=DB::getConn()->prepare('SELECT * FROM amizade WHERE de=? or para=? ');
	$verificacao->execute(array($iddasessao,$iddasessao));
	if($verificacao->rowCount()==0){
		echo"<p>Você necessita ser amigo dessa pessoa para postar.</p>";
	}else{
		echo'<table width="300" border="0">
  <tr>
    <td align="left" valign="top"><img src="uploads/usuario/'.$user_imagem.'" width="66" height="62"></td>
    <td align="left" valign="top"><form action="" method="post" enctype="multipart/form-data" name="comentario">
    <textarea name="coment" cols="50" rows="5" wrap="physical" required></textarea>
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