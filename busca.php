<?php include('includes/header.php');?> ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>EducationLife - Busca</title>
<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 8]>
<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
</head>

<body>  
	    <?php include('includes/toolbar.php'); ?>
<div id="amigos"> <span class="supertitulo" style="padding-top:10px; padding-left:10px;"><h2>Resultado das Pesquisas</h2></span>
  <span style="padding-top:10px; padding-left:10px;"><h3>Busca de Usu&aacute;rio</h3></span>
  <?php 
			if(''<>$_GET['s']){
				$explode=explode(' ',$_GET['s']);
				$numP=count($explode);
				for($i=0; $i<$numP;$i++){
					$busca = " (`nome` LIKE :busca$i or `sobrenome` LIKE :busca$i)";
					if($i<>$numP-1){
						$busca .=' AND ';
					}
				}
				$buscar=DB::getConn()->prepare("SELECT * FROM `usuarios` WHERE $busca");
				for($i=0; $i<$numP;$i++){
					$buscar->bindValue(":busca$i",'%'.$explode[$i].'%',PDO::PARAM_STR);
				}
				$buscar->execute();
				if($buscar->rowCount()>0){
					while($resbusca=$buscar->fetch(PDO::FETCH_ASSOC)){
						echo' <div class="show" id='.$resbusca['nome'].'><a href="perfil.php?uid='.$resbusca['id'].'">
							  <img src="uploads/usuario/'.$resbusca['imagem'].'" width="175" height="150" /></br>
							  <p align="center"><b>'.$resbusca['nome'].'</b></p></a></div>			  
							  ';
					}
					}
				else{
					echo'  Nenhum usuário encontrado.';
				}
				
			} 
			if(''<>$_GET['s']){
				$explode=explode(' ',$_GET['s']);
				$numP=count($explode);
				for($i=0; $i<$numP;$i++){
					$busca = " (`nome` LIKE :busca$i and `nome` LIKE :busca$i )";
					if($i<>$numP-1){
						$busca .=' AND ';
					}
				}
				$buscar=DB::getConn()->prepare("SELECT * FROM `instituicao` WHERE $busca");
				for($i=0; $i<$numP;$i++){
					$buscar->bindValue(":busca$i",'%'.$explode[$i].'%',PDO::PARAM_STR);
				}
				$buscar->execute();
				if($buscar->rowCount()>0){
					while($resbusca=$buscar->fetch(PDO::FETCH_ASSOC)){
						echo' <div class="show" id='.$resbusca['nome'].'><a href="inst.php?cid='.$resbusca['id'].'">
							  <img src="uploads/usuario/'.$resbusca['imagem'].'" width="175" height="150" /></br>
							  <p align="center"><b>'.$resbusca['nome'].'</b></p></a>
							  </div>				  
							  ';
					}
				}
				else{
					echo'  Nenhuma instituição encontrada.';
				}
			}
		?>
    </div>

      	<br>
        <br>
        <br>
</body>
</html>