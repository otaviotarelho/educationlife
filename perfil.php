<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
<?php include('includes/header.php');?>
<?php include('includes/amigos.php');?>
<title>EducationLife - <?php $select=DB::getConn()->prepare("SELECT * FROM `usuarios` WHERE `id`=? LIMIT 1");
$select->execute(array($_GET['uid']));
$nome=$select->fetch(PDO::FETCH_ASSOC);
echo $nome['nome'];?> - Perfil </title>
<!--[if lte IE 8]>
<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
</head>

<body>
<?php include('includes/toolbar.php'); ?>
<?php		
	$meusdados=DB::getConn()->prepare("SELECT * FROM `usuarios` WHERE `id`=? LIMIT 1");
	$meusdados->execute(array($_GET['uid']));
	if($meusdados->rowCount()==1){
				$asmeusdados=$meusdados->fetch(PDO::FETCH_ASSOC);	
	}
	else{
		header('location:perfil.php?uid='.$iddasessao.'');
	}
	
?>
<div class="fluid">
  <div class="informacoes">
    <table width="760" height="176" border="0" align="center">
      <tr>
        <th width="184" rowspan="5" nowrap="nowrap"><img src="uploads/usuario/<?php echo $asmeusdados['imagem'];?>" width="175" height="150"></th>
        <td width="541" style="padding-top:10px;"><?php echo $asmeusdados['nome'].' '.$asmeusdados['sobrenome'];if($iddasessao==$_GET['uid']){
					echo' - Meu Perfil';	}?>
             	<?php 
				if($iddasessao<>$idExtrangeiro){
					if($idExtrangeiro<>0){	
				$e_meu_amigo=DB::getConn()->prepare("SELECT * FROM `amizade` WHERE (de=? AND para=?) or (para=? AND de=?) LIMIT 1");
				$e_meu_amigo->execute(array($iddasessao, $idExtrangeiro,$iddasessao, $idExtrangeiro));
				if($e_meu_amigo->rowCount()==0){
					echo' | <a href="php/amizade.php?ac=convite&de='.$iddasessao.'&para='.$idExtrangeiro.'">Adicionar a Amigos</a>';
				}else{
					$asstatusamizade=$e_meu_amigo->fetch(PDO::FETCH_ASSOC);
					if($asstatusamizade['status']==0){
						echo' | <a href="php/amizade.php?ac=remover&de='.$iddasessao.'&para='.$idExtrangeiro.'">Cancelar Pedido</a>';
					}
					else{
						echo' | <a href="php/amizade.php?ac=remover&de='.$iddasessao.'&para='.$idExtrangeiro.'">Remover Amigo</a>';
				    }
					}
					}
				}
			?>
        	
        </td>
      </tr>
      <tr>
        <td>Sobre mim:</td>
      </tr>
      <tr>
        <td>Membro desde: <?php echo $asmeusdados['cadastro']; ?></td>
      </tr>
      <tr>
        <td>Minhas Institui&ccedil;&otilde;es:</tr>
      <tr>
        <td valign="top"><?php 
			$membroverificacao=DB::getConn()->prepare("SELECT * FROM membros WHERE de=?");
			$membroverificacao->execute(array($idExtrangeiro));
			if($membroverificacao->rowCount()==0){
				$usermaster=DB::getConn()->prepare("SELECT * FROM instituicao WHERE usermaster=?");
				$usermaster->execute(array($idExtrangeiro));
				if($usermaster->rowCount()==0){
					echo"Nenhuma instituicão";
				}
				else{
					while($usermaster2=$usermaster->fetch(PDO::FETCH_ASSOC)){
					echo' |  <a href="inst.php?cid='.$usermaster2['id'].'">'.$usermaster2['nome'].' (Administrador)';
					}
				}
			}else{
				$informa=$membroverificacao->fetch(PDO::FETCH_ASSOC);
				$user=DB::getConn()->prepare("SELECT * FROM instituicao WHERE id=?");
				$user->execute(array($informa['para']));
				while($userinfo=$user->fetch(PDO::FETCH_ASSOC)){
				echo' | <a href="inst.php?cid='.$userinfo['id'].'">'.$userinfo['nome'].'</a>';
				}
			}
						
		?></td>
      </tr>
    </table>
  </div>
  <div class="attperfil"><b>Meus amigos(<?php echo $numamigos; ?>): <a href="exibir.php?uid=<?php echo $idExtrangeiro; ?>">Ver Todos</a></b></br>
  <?php 
	 	if($numamigos>0){
			echo '<table><tr>';
			while($resamigo=$selamigo->fetch(PDO::FETCH_ASSOC)){
				
					
						echo' 
							  <td aling="center" style="text-decoration:none;"><a href="perfil.php?uid='.$resamigo['id'].'">
							  <img src="uploads/usuario/'.$resamigo['imagem'].'" width="114" height="100"  /></br>
							  </td>				  
							  ';
					
			}
			echo'</tr></table>';
		}
		else{
			echo'Ops! Nenhum amigo! Adicione agora!';
		}
	?></div>
  <div class="attsuser"><p class="supertitulo"><b> Atualiza&ccedil;&otilde;es</b><p>
  <?php
			$meusupdate = DB::getConn()->prepare("SELECT p.id, u.nome, u.sobrenome, u.imagem, p.text, p.posted, p.por FROM usuarios u, updates p WHERE u.id=? AND p.por=? ORDER BY p.posted desc");
			$meusupdate->execute(array($idExtrangeiro, $idExtrangeiro));
			echo'<table width="451" height="132" border="0" style="margin:auto;">';
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
			echo'</table><br><br>';

 ?> 
  </div>
</div>

</body>
</html>