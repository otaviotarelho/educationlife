<?php include('includes/header.php');
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 8]>
<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
<title>EducationLife - Institui&ccedil;&atilde;o -
 <?php $select=DB::getConn()->prepare("SELECT * FROM `instituicao` WHERE `id`=? LIMIT 1");
$select->execute(array($_GET['cid']));
$nome=$select->fetch(PDO::FETCH_ASSOC);
echo $nome['nome'];?></title></head>
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
<body>
<?php 
	$getDados=DB::getConn()->prepare('SELECT * FROM instituicao WHERE `id`=?');
	$getDados->execute(array($idExtrangeiroInst));
	if($getDados->rowCount()!=0){
		$resultInst=$getDados->fetch(PDO::FETCH_ASSOC);
	}
	else{
		header('Location: ./');
	}
?>
<?php include('includes/toolbar.php'); ?>
<div class="fluid">
  <div class="menudiv"><?php 
				$e_meu_amigo=DB::getConn()->prepare("SELECT * FROM `membros` WHERE (de=? AND para=?) or (para=? AND de=?) LIMIT 1");
				$e_meu_amigo->execute(array($iddasessao, $idExtrangeiroInst,$iddasessao, $idExtrangeiroInst));
				$e_minha_inst=DB::getConn()->prepare("SELECT * FROM `instituicao` WHERE `usermaster`=? LIMIT 1");
				$e_minha_inst->execute(array($iddasessao));
				$result=$e_minha_inst->fetch(PDO::FETCH_ASSOC);
				if($result['usermaster']==$iddasessao){
					echo'<a href="dados.php">Alterar Dados</a> | <a href="gerenciar.php?id='.$idExtrangeiroInst.'&user='.$iddasessao.'">Gerenciar Membros</a> ';
					echo' - Bem Vindo Professor!';
					
				}
				else{
					if($e_meu_amigo->rowCount()==0){
					echo'<a href="php/community.php?ac=convite&de='.$iddasessao.'&para='.$idExtrangeiroInst.'">Adicionar Instituição</a>';
				}else{
					$asstatusamizade=$e_meu_amigo->fetch(PDO::FETCH_ASSOC);
					if($asstatusamizade['status']==0){
						echo' <a href="php/community.php?ac=remover&de='.$iddasessao.'&para='.$idExtrangeiroInst.'">Cancelar Pedido</a>';
					}
					else{
						echo' <a href="php/community.php?ac=remover&de='.$iddasessao.'&para='.$idExtrangeiroInst.'">Remover Instituição</a>';
				    }
				}
				}
						
		?></div>
  <div class="informacoes"><table width="760" height="176" border="0" align="center">
      <tr>
        <th width="184" rowspan="5" nowrap="nowrap"><img src="uploads/usuario/<?php echo $resultInst['imagem'];?>" width="175" height="150"></th>
        <td width="541" style="padding-top:10px;"><b><?php echo $resultInst['nome'];?>
        </b></td>
      </tr>
      <tr>
        <td>Dados da Institui&ccedil;&atilde;o</td>
      </tr>
      <tr>
        <td>Membro desde:<?php echo $resultInst['cadastro'];?></td>
      </tr>
      <tr>
        <td>Tipo:
        	<?php if ($resultInst['nivel']==1){
					echo"Escola Pública";
				  }	else if($resultInst['nivel']==2){
				  	echo"Escola Particular";
				  }
				  else if($resultInst['nivel']==3){
				  	echo"Centro de Línguas";
				  }
			?>
        </tr>
      <tr>
        <td align="left" valign="top">Sobre a Institui&ccedil;&atilde;o:<?php echo $resultInst['descricao'];?></td>
      </tr>
    </table></div>
  <div class="attperfil">
    <p class="supertitulo"><b>Membros <a href="exibir.php?cid=<?php echo $idExtrangeiroInst; ?>">Ver Todos</a></b><br>
  </p>
  <?php 
  		$membros=DB::getConn()->prepare("SELECT de FROM membros WHERE para=? LIMIT 0,10");
		$membros->execute(array($idExtrangeiroInst));
		if($membros->rowCount()<>0){
		echo '<table><tr>';
		while($resmembros=$membros->fetch(PDO::FETCH_ASSOC)){
			$informacoes=DB::getConn()->prepare("SELECT * FROM usuarios WHERE id=?");
			$informacoes->execute(array($resmembros['de']));
			$resultinforma=$informacoes->fetch(PDO::FETCH_ASSOC);
			echo' 
				<td aling="center" style="text-decoration:none;"><a href="perfil.php?uid='.$resultinforma['id'].'">
							  <img src="uploads/usuario/'.$resultinforma['imagem'].'" width="88" height="77"  /></br>
							  </td>				  
							  ';
					
			}
			echo'</tr></table>';
		}
		else{
			echo'Ops! Nenhum membro! Adicione agora!';	
		}
  ?>  
  </div>
  <div class="attsuser">
  <p class="supertitulo"><b>T&oacute;picos</b> - <a href="newtopico.php?cid=<?php echo $idExtrangeiroInst;?>">Novo T&oacute;pico</a></p>
  <?php
  	$meustopicos=DB::getConn()->prepare("SELECT t.nome, t.descricao, t.id, t.id_autor FROM `topicos` t INNER JOIN `instituicao` i ON (t.id_inst=i.id and i.id=?) ORDER BY t.id LIMIT ".$totalinicio.",".$totalfinal."");
	$meustopicos->execute(array($idExtrangeiroInst));
	$rows=$meustopicos->rowCount();
	while($resulttopic=$meustopicos->fetch(PDO::FETCH_ASSOC)){
	if($meustopicos->rowCount()==0){
		echo" <p id='supertitulo'>Não há tópicos</p>";
	}else{
		$autor=DB::getConn()->prepare("SELECT nome, id, imagem FROM usuarios WHERE id=?");
		$autor->execute(array($resulttopic['id_autor']));
		while($resultautor=$autor->fetch(PDO::FETCH_ASSOC)){
		echo'<table  border="0" valign="top" style="margin-left:10px;" ">
  			<tr>';
		
		    echo'<td rowspan="2" valign="top"><img src="uploads/usuario/'.$resultautor['imagem'].'" alt="" width="66" height="62" /></td>
    <td width="370" valign="top"><a href="topico.php?cid='.$idExtrangeiroInst.'&topico='.$resulttopic['id'].'">'.$resulttopic['nome'].'</a><br />
      Autor:'.$resultautor['nome'].'<br />Descrição:'.$resulttopic['descricao'].'</td>';
		echo"</tr></table>";
		}
	}
	}
  
  ?>
  <?php 
	if($totalfinal<=$rows){
	    $pagina=$pagina+1;
		echo'<div class="navigation" style="padding-right:10px;"><div class="page" align="right" width="50%"><a href="?cid='.$idExtrangeiroInst.'&page='.$pagina.'">Mais Antigos</a></div></div><br>';
      }
      else{
        $pagina=1;
      	echo'<div class="navigation" style="padding-left:10px;"><div class="page" align="left" width="50%"><p><a href="?cid='.$idExtrangeiroInst.'&page=1">Inicio</a></p></div></div><br>';
      }
?></div>
 </div>

</body>
</html>