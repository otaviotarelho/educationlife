<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>EducationLife</title>
<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 8]>
<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
</head>

<body>
<div id="topo"></div>
<div id="tabelamedia">
  <p>Desculpe mais ocorreu um erro!<br> Login ou senha invalidos. <?php
  				   	include('classes/DB.class.php');
					include('classes/Login.class.php');
					$objLogin = new Login;
				    if(isset($_POST['logar'])){
					if($objLogin->logar($_POST['email'],$_POST['senha'],$_POST['lembrar'])){
						header('Location: ./');
						exit;
					}else{
						echo $objLogin->erro;
					}
				}?></p>
  <div id="dentroerrotext1"><form action="" method="post" name="login" align="center">
    <p><br />
      </p>
    <p>&nbsp;</p><h1><a href="index.php" >Retornar a pagina inicial </a></h1>    
    </p>
    <p>&nbsp;</p>
    </form>
  </div>
  <div id="dentroerrotext2">
    <p align="center">Não possui conta ainda? Cadastre-se!</p>
	<form action="" method="post" target="_blank">
      <center><p>
        <input name="Cadastro de Usuário" type="button" value="Cadastro de Usuário" class="cadastro" onclick="location.href = 'caduser.php'"/>
      </p>
      <p>
        <input name="Cadastro de Instituição" type="button" value="Cadastro de Instituição" class="cadastro" onclick="location.href ='cadinst.php'"/>
      </p></center>
    </form> 
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>

</div>
   
</body>
</html>