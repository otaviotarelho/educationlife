<?php include('includes/header.php');?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>EducationLife - Institui&ccedil;&otilde;es</title>
<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 8]>
<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
</head>

<body>
	<?php include('includes/toolbar.php'); ?>
	<?php include('includes/instui.php');?>
      <div id="amigos">
    	<div class="supertitulo">Membros da Institui&ccedil;&atilde;o(<?php echo $numamigos2; ?>)</br></br></div>
     
    <?php 
		if($idExtrangeiro=$iddasessao){
	 	if($numamigos2>0){
			while($resultinst=$selamigo->fetch(PDO::FETCH_ASSOC)){
				echo' <div class="show"><a href="inst.php?cid='.$resultinst['id'].'">
							  <img src="uploads/usuario/'.$resultinst['imagem'].'" width="175" height="150" /></br>
							  <p align="center"><b>'.$resultinst['nome'].'</b></p></a>
							  </div>			  
							  ';
			}
		}
		else{
			echo"Não há instituições";
		}
		}else{
			header("location: ./");
		}
	?></div>
</body>
</html>