<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Bem-Vindo ao Education Life - Login</title>
<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 8]>
<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
</head>
<body>
<div id="centro">
  <div id="esquerda"><p class="supertitulo">Sobre</p>
    <p align="center"> <img src="img/about.png" width="263" height="141" alt="About">    </p>
    <p class="supertitulo" align="justify"> O projeto EducationLife &eacute; um site onde o usu&aacute;rio tem acesso ao maior conte&uacute;do multim&iacute;dia relacionado &agrave;s mais diversas disciplinas, propiciando uma melhora no aprendizado, atrav&eacute;s de m&eacute;todos diferenciados.</p>
 
  </div>
  <div id="direita">
 
    <p class="supertitulo" align="justify">Objetivos</p>
    <p align="center"><img src="img/objectives.jpg" width="269" height="142"></p>
    <p class="supertitulo"><span> O objetivo do projeto &eacute; criar um ambiente, em formato de f&oacute;rum, favor&aacute;vel ao compartilhamento de informa&ccedil;&otilde;es, associando um site educacional a uma rede social, aumentando a interatividade entre os alunos e professores al&eacute;m de tirar d&uacute;vidas.</span><br>
  </p>
  </div>
  <div id="direita"><p class="supertitulo">Login <?php if(isset($_POST['logar'])){
					if($objLogin->logar($_POST['email'],$_POST['senha'],$_POST['lembrar'])){
						header('Location: ./');
						exit;
					}else{
						echo $objLogin->erro;
					}
				}?>
    </p>
                   
    <form action="" id="loginform" method="post" enctype="multipart/form-data" name="logar" align="center">
          
          <center>	<p>
      <input type="email" name="email" class="login" required />
         <br />
        </p>
       <p>
         <input type="password" name="senha" class="login" required />
       </p>
       <p>
         <input type="submit" name="logar" id="botaoenviar" value="Logar" />
         <input type="checkbox" name="lembrar" id="conect" />
         <label for="conect"></label>
         Manter Conectado </p>
       </center>
    </form>
   
    <p class="supertitulo">Novo Aqui?</p>

      <center>
        <p>
        <input name="Cadastro de Usuário"  onclick="location.href = 'caduser.php'"  type="button" value="Cadastro de Usuário" class="cadastro" />
        </p>
      <p>
        <input name="Cadastro de Instituição" type="button" value="Cadastro de Instituição"  onclick="location.href ='cadinst.php'" class="cadastro" />
        <br>
        <br>
        <p align="center"><a href="faq.php">Ajuda  |  </a> <a href="politica.php" >Politica de uso</a>
      </p></center>
   
    </div>
  <p>&nbsp;</p>
</div>
</body>
</html>