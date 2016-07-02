<?php include('includes/header.php');?>
<?php 
	if(isset($_GET['page']) and $_GET['page']>1 ){
		$pagina=$_GET['page'];
		$totalfinal=9;
		$totalinicio=($pagina-1)*9;
		echo"$pagina, $totalfinal, $totalinicio";
	}
	else if(isset($_GET['page']) and $_GET['page']==1){
		$pagina=1;
		$totalfinal=$pagina*9;
		$totalinicio=0;
	}
	else{
		$pagina=1;
		$totalfinal=$pagina*9;
		$totalinicio=0;
	}
?>
<!DOCTYPE html>
<head>
<script type="text/javascript" src="js/jquery.js" ></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>EducationLife - Home</title>
<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 8]>
<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
</head>
<body>
<?php include('includes/toolbar.php'); ?>
<?php include('includes/amigos.php');?>
<?php include('includes/instui.php');?>
<div id="uniao">
<div id="informacoes">
<div id="imagem"><a href="perfil.php?uid=<?php echo $iddasessao; ?>"><img src="uploads/usuario/<?php echo $user_imagem;?>" width="175" height="150"></a></div><a href="amigos.php">
<div id="instituicoes">Amigos (<?php echo $numamigos; ?>)</div></a><a href='instituicao.php?uid=<?php echo $iddasessao; ?>'>
<div id="instituicoes">Institui&ccedil;&otilde;es (<?php echo $numamigos2;?>)</div></a><a href="notificacoes.php">
<div id="notificacoes">Notifica&ccedil;&otilde;es</div></a>
<a href="dados.php">
<div id="notificacoes">Seus Dados</div></a>
</div>

<div id="atualizacao">
	<?php 
		if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST'){
			$update=$_POST['updatetext'];
			if(isset($_SESSION['last_update'])&&$_SESSION['last_update']==$update){
			}
			else{
			$_SESSION['last_update']=$update;
			$verificar = DB::getConn()->prepare("INSERT INTO `updates` SET `por`=?, `text`=?, `type`=?");
			$verificar->execute(array($iddasessao,$update,'0'));						
		}
		}
	 ?>
  O que voc&ecirc; est&aacute; pensando?
  <div id="campoatt"><form name="update" method="post" action="">
  <table width="427" border="0">
  <tr>
    <td width="440"><textarea name="updatetext" cols="55" rows="3" placeholder="Clique para ativar" required></textarea></td>
  </tr>
  <tr>
    <td><div align="right">
      <input type="submit" name="ok" id="ok" value="OK"></div></td>
  </tr>
</table>    
    </form>
  </div>
  <div id="updatesuser" style="margin:auto;"><?php
  			/*Pegando os Amigos*/
			
  			$updatesamigos=DB::getConn()->prepare("SELECT * FROM amizade WHERE de=? or para=?");
			$updatesamigos->execute(array($iddasessao,$iddasessao));
			if($updatesamigos->rowCount()==0){
				$meusupdate = DB::getConn()->prepare("SELECT p.id, p.posted,p.por, u.nome, u.imagem, p.text FROM usuarios u, updates p WHERE (u.id=? AND p.por=?) AND (u.id=? AND p.por=?) ORDER BY p.posted DESC LIMIT ".$totalinicio.",".$totalfinal."");
			$meusupdate->execute(array($iddasessao,$iddasessao,$iddasessao,$iddasessao));
			$rows=$meusupdate->rowCount();
			echo'<table width="100%" border="0">';
			while($resmeuupdate=$meusupdate->fetch(PDO::FETCH_ASSOC)){
						$numcoment = DB::getConn()->prepare("SELECT * FROM postagem WHERE onde=?");
						$numcoment->execute(array($resmeuupdate['id']));
						$id=$resmeuupdate['id'];
						$total=$numcoment->rowCount();
						echo'<tr class="postedPost" id="'.$id.' postedPost ">
    						<td width="11%" align="left" valign="top" ><img src="uploads/usuario/'.$resmeuupdate['imagem'].'" width="48" height="47" /></td>
    						<td width="89%" align="left" valign="top" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; ">'.$resmeuupdate['nome'].' postou:<br>'.$resmeuupdate['text'].'
							<br>
							<br>
							<div align="right" style="font-size:12px; color:#999;" > Data:'.$resmeuupdate['posted'].' |  <a href="comupdates.php?iduser='.$resmeuupdate['por'].'&idpostagem='.$resmeuupdate['id'].'">Comentarios('.$total.')</a></div>
							<hr align="center" width="80%" size="1" color=#CCC></td>
  							</tr>
							  ';
			}
			echo'</table>
			<br><br>';
			}else{
			while($fullupdates=$updatesamigos->fetch(PDO::FETCH_ASSOC)){
			$meusupdate = DB::getConn()->prepare("SELECT p.id, p.posted,p.por, u.nome, u.imagem, p.text FROM usuarios u, updates p WHERE (u.id=? AND p.por=?) or (u.id=? AND p.por=?) ORDER BY p.posted DESC LIMIT ".$totalinicio.",".$totalfinal." ");
			$meusupdate->execute(array($fullupdates['de'], $fullupdates['de'],$fullupdates['para'],$fullupdates['para']));
			$rows=$meusupdate->rowCount();
			echo'<table width="90%" border="0" bgcolor=white>';
			while($resmeuupdate=$meusupdate->fetch(PDO::FETCH_ASSOC)){
						$numcoment = DB::getConn()->prepare("SELECT * FROM postagem WHERE onde=?");
						$numcoment->execute(array($resmeuupdate['id']));
						$total=$numcoment->rowCount();
						echo $todas='<tr>
    						<td width="11%"  align="left" valign="top" ><a href="perfil.php?uid='.$resmeuupdate['por'].'"><img src="uploads/usuario/'.$resmeuupdate['imagem'].'" width="48" height="47" /></a></td>
    						<td width="89%" align="left" valign="top" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; "><a href="perfil.php?uid='.$resmeuupdate['por'].'">'.$resmeuupdate['nome'].'</a> postou:<br>'.$resmeuupdate['text'].'
							<br>
							<br>
							<div align="right" style="font-size:12px; color:#999;" > Data:'.$resmeuupdate['posted'].' |  <a href="comupdates.php?iduser='.$resmeuupdate['por'].'&idpostagem='.$resmeuupdate['id'].'">Comentarios('.$total.')</a></div>
							<hr align="center" width="80%" size="1" color=#CCC></td>
  							</tr>
							';
			}echo"</table>";
			}
			}
			
		
 ?>
  </div>
  <?php 
	if($totalfinal<=$rows){
	    $pagina=$pagina+1;
		echo'<div class="navigation"><div class="page" align="right" width="50%"><a href="?page='.$pagina.'">Mais Antigos</a></div></div><br>';
      }else if ($rows==0){
	  }
      else{
        $pagina=1;
      	echo'<div class="navigation"><div class="page" align="left" width="50%"><p><a href="?page=1">Inicio</a></p></div></div><br>';
      }
	  
?></div><br></div>
</body>
</html>