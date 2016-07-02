<?php include('includes/header.php');?> ?>
<?php 
	if(isset($_GET['page']) and $_GET['page']>1 ){
		$pagina=$_GET['page'];
		$totalfinal=3000;
		$totalinicio=($pagina-1)*50;
	}
	else if(isset($_GET['page']) and $_GET['page']==1){
		$pagina=1;
		$totalfinal=$pagina*50;
		$totalinicio=0;
	}
	else{
		$pagina=1;
		$totalfinal=$pagina*50;
		$totalinicio=0;
	}
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>EducationLife - Gerenciar usu&aacute;rios</title>
<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 8]>
<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
</head>

<body>  
	    <?php include('includes/toolbar.php'); ?>
<div id="amigos"> <span class="supertitulo" style="padding-top:10px; padding-left:10px;"><h2>Gerenciar usuários.</h2> 
Esse é o painel de gerenciamento de usuário, qualquer alteração aqui é irreversivel.<a href="inst.php?cid=<?php echo $_GET['id']?>"> Voltar.</a></span><br>
	<?php 
		if(isset($_GET['id']) and isset($_GET['user']) ){
		$verificacao=DB::getConn()->prepare("SELECT * FROM instituicao where id=?  and usermaster=?");
		$verificacao->execute(array($_GET['id'],$_GET['user']));
		if($verificacao->rowCount()==1){	
		$instmembros=DB::getConn()->prepare("SELECT de FROM membros where para=? LIMIT ".$totalinicio.",".$totalfinal."");
		$instmembros->execute(array($_GET['id']));
		while($membros=$instmembros->fetch(PDO::FETCH_ASSOC)){
		$gerenciar=DB::getConn()->prepare("SELECT nome, id FROM usuarios WHERE id=?");
		$gerenciar->execute(array($membros['de']));
		$linha=$instmembros->rowCount();
		$tent=0;   
		echo'<div align="center"><table width="40%" border="0">
      ';	  	
		while($gerem=$gerenciar->fetch(PDO::FETCH_ASSOC)){
			if($tent==0){
			echo'<tr>
				<td width="81%">'.$gerem['nome'].'</td>
        		<td width="19%"><a href="php/gerenciardel.php?id='.$_GET['id'].'&user='.$iddasessao.'&del='.$gerem['id'].'">Deletar</a></td>
      			</tr>';
				$tent=1;
			}else{
				echo'<tr>
				<td width="81%" bgcolor="#F7F7F7">'.$gerem['nome'].'</td>
        		<td width="19%" bgcolor="#F7F7F7"><a href="php/gerenciardel.php?id='.$_GET['id'].'&user='.$iddasessao.'&del='.$gerem['id'].'">Deletar</td>
      			</tr>';			
			    $tent==0;
			}
		}
		echo'</table></div>';
		}
		}}
		else{
			header("location: inst.php?cid=".$_GET['id']."");
		}
	echo"<br>";
	  
?></div>

      	<br>
        <br>
        <br>
</body>
</html>