<?php include('includes/header.php');?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>EducationLife - Amigos</title>
<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 8]>
<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
</head>

<body>
	<?php include('includes/toolbar.php'); ?>
	<?php include('includes/amigos.php');?>
      <div id="amigos">
    	<div class="supertitulo">Meus Amigos(<?php echo $numamigos; ?>)</br></br></div>
     
    <?php 
	 	if($numamigos>0){
			while($resamigo=$selamigo->fetch(PDO::FETCH_ASSOC)){
				
					
						echo'<div class="show"><a href="perfil.php?uid='.$resamigo['id'].'">
							  <img src="uploads/usuario/'.$resamigo['imagem'].'" width="175" height="150" /></br>
							  <p align="center"><b>'.$resamigo['nome'].'</b></p></a></div>				  
							  ';
					
			}
		}
		else{
			echo'Ops! Nenhum amigo?';
		}
	?></div>
</body>
</html>