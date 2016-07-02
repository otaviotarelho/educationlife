<?php session_start(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Bem-Vindo ao Education Life - Cadastro de instituição</title>
<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
<title>EducationLife - Cadastro de instituição</title>
<!--[if lte IE 8]>
<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready( function() {
	$("#cadastro").validate({
		// Define as regras
		rules:{
			nome:{
				required: true, minlength: 5
			},
			desc:{
				required: true, minlength: 20
			},
			email:{
				required: true, email: true
			}
		},
		// Define as mensagens de erro para cada regra
		messages:{
			nome:{
				required: "Digite o seu nome",
				minLength: "O seu nome deve conter, no mínimo, 2 caracteres"
			},
			desc:{
				required: "Digite a descrição da instituição",
				minLength: "A sua descrição deve conter, no mínimo, 20 caracteres"
			},
			email:{
				required: "Digite o seu e-mail de usuário",
				email: "Digite um e-mail válido"
			}
			
		}
	});
});</script>
</head>

<body>
<div id="topo"><a href="./" style="color:#FFF; margin-left:5px;">Voltar</a></div>
<div id="caduser"><h2>Cadastro de Instituição. (Requer conta de usuário)</h2><?php 


	if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST'){	
	extract($_POST);
	
	include('classes/DB.class.php');																
								$verificar = DB::getConn()->prepare("SELECT `id` FROM `usuarios` WHERE `email`=?");
								if($verificar->execute(array($email))){
									if($verificar->rowCount()>=1){
										$resverificar=$verificar->fetch(PDO::FETCH_ASSOC);
										$usermaster=$resverificar['id'];
										$inserir = DB::getConn()->prepare('INSERT INTO `instituicao` SET `nome`=?, `descricao`=?, `usermaster`=?, `imagem`="default.png", `nivel`=1, `status`=0');
										if($inserir->execute(array($nome,$desc,$usermaster))){
											header('Location: ./');
										
										
																
									}else{
										echo '<h3>Este e-mail não esta cadastrado em nosso sistema';		
										}
								}
							}
							echo '</h3>';
	}
?><blockquote><i>Atenção: Não esqueça de ler às regras de privacidade. <a href="politica.php">Clique aqui para visualizar</a></i></blockquote>
<br />
<form id="cadastro" name="cadastro" style="width:97%" action="" method="POST">
  <fieldset>
    <legend>Dados Pessoais.</legend>
    <table width="100%" border="0">
  	  <tr>
  	    <td  class="aligntxtcad"><label for="nome">Nome da Instituição</label></td>
  	    <td ><input id="nome" name="nome" type="text" autofocus required size="30" maxlength="30"></td>
      </tr>
       <tr>
  	    <td class="aligntxtcad"><label for="descricao">Descrição da Instituição:</label></td>
  	    <td > <input name="desc"  id="desc" type="text" required size="50" maxlength="139"> </td>
      </tr>
          <tr>
        <td class="aligntxtcad"><label for="email">E-mail:</label></td>
  	    <td><input type="email" id="email" name="email" size="50" required></td>
        <tr>
              </tr>
    </table></fieldset> <h6 align="right">Todos os campos são obrigatórios.</h6>
      <input class="submit" type="submit" value="Enviar" name="enviar" >
      <input type="reset" name="limpardados" value="Limpar">
</form><br /></div>
</body>
</html>