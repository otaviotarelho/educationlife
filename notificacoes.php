<?php include('includes/header.php'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 8]>
<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
<title>Education Life - Solicitações de Amizade</title>
</head>

<body>
	<?php include('includes/toolbar.php'); ?>
	<div id="amigos"><h4 style="">Notificações de Amizade
      </h4>
	  <p>
        <?php 
				$e_meu_amigo=DB::getConn()->prepare("SELECT * FROM `amizade` WHERE para=? AND `status`=0");
				$dadosamizade=DB::getConn()->prepare("SELECT * FROM `usuarios` WHERE `id`=?");
				$e_meu_amigo->execute(array($iddasessao));
				if($e_meu_amigo->rowCount()>0){
					echo'<ul>';
					while($resmeuamigo=$e_meu_amigo->fetch(PDO::FETCH_ASSOC)){
						$dadosamizade->execute(array($resmeuamigo['de']));
						$asdadosamizade=$dadosamizade->fetch(PDO::FETCH_ASSOC);
					echo'<li>'.$asdadosamizade['nome'].' '.$asdadosamizade['sobrenome'].' quer ser seu amigo. <a href="php/amizade.php?ac=aceitar&de='.$resmeuamigo['de'].'&para='.$iddasessao.'">Aceitar</a> | <a href="php/amizade.php?ac=remove&de='.$resmeuamigo['de'].'&para='.$iddasessao.'">Recusar</a> </li>';
					}
					echo'</ul>';
				}else{
					echo'Nenhuma Solicitação de Amizade.';
				}
				
				
	
	?>
        </br>
      </p>
      <p>&nbsp;</p>   <?php 
				$verificacao=DB::getConn()->prepare("SELECT * FROM instituicao WHERE usermaster=?");
				$verificacao->execute(array($iddasessao));
				if($verificacao->rowCount()==0){
				}else{
      			echo'<h4 style="">Notificações Instituições</h4></br>';
 				$e_meu_amigo=DB::getConn()->prepare("SELECT * FROM `membros` m INNER JOIN instituicao i ON (i.id=m.para and i.usermaster=? and m.status=0)");
				$dadosamizade=DB::getConn()->prepare("SELECT * FROM `usuarios` WHERE `id`=?");
				$e_meu_amigo->execute(array($iddasessao));
				if($e_meu_amigo->rowCount()>0){
					echo'<ul>';
					while($resmeuamigo=$e_meu_amigo->fetch(PDO::FETCH_ASSOC)){
						$dadosamizade->execute(array($resmeuamigo['de']));
						$asdadosamizade=$dadosamizade->fetch(PDO::FETCH_ASSOC);
					echo'<li>'.$asdadosamizade['nome'].' '.$asdadosamizade['sobrenome'].' quer fazer parte da sua instituição. <a href="php/community.php?ac=aceitar&de='.$resmeuamigo['de'].'&para='.$resmeuamigo['para'].'">Aceitar</a> | <a href="php/community.php?ac=remove&de='.$resmeuamigo['de'].'&para='.$resmeuamigo['para'].'">Recusar</a> </li>';
					}
					echo'</ul>';
				}else{
					echo'Nenhum usuário requer acesso as suas instituições.';
				}
				}
				
	
	?>    
    </div>
</body>
</html>