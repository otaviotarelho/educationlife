<?php session_start(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Bem-Vindo ao Education Life - Cadastre-se</title>
<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
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
			sobrenome:{
				required: true, minlength: 5
			},
			email:{
				required: true, email: true
			},
			nascimento:{
				required: true,minlength: 8 
			},
			nome:{
				required: true,minlength: 5 
			},
			senha:{
				required: true,minlength: 5
			}
		},
		// Define as mensagens de erro para cada regra
		messages:{
			sobrenome:{
				required: "Digite o seu nome",
				minLength: "O seu nome deve conter, no mínimo, 5 caracteres"
			},
			email:{
				required: "Digite o seu e-mail para contato",
				email: "Digite um e-mail válido"
			},
			nascimento:{
				required: "Digite a sua data de nascimento",
				minLength: "Sua data de nascimento deve conter, no mínimo, 8 caracteres"
				},
			nome:{
				required: "Digite o seu nome",
				minLength: "O seu nome deve conter, no mínimo, 5 caracteres"
			},
			senha:{
				required: "Digite a sua senha",
				minLength: "sua senha nome deve conter, no mínimo, 5 caracteres"}
			
		}
	});
});</script>
</head>

<body>
<div id="topo"><a href="./" style="color:#FFF; margin-left:5px;">Voltar</a></div>
<div id="caduser">
<h2>Cadastro de Usuário.</h2><?php 


	if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST'){	
	extract($_POST);
	
	include('classes/DB.class.php');	
								$emailInsert = sha1($email);															
								$verificar = DB::getConn()->prepare("SELECT `id` FROM `usuarios` WHERE `email`=?");
								if($verificar->execute(array($emailInsert))){
									if($verificar->rowCount()==1){
										echo 'Este e-mail ja esta cadastrado em nosso sistema';								
									}else{								
										$senhaInsert = sha1($senha);
										$inserir = DB::getConn()->prepare('INSERT INTO `usuarios` SET `email`=?, `senha`=?, `nome`=?, `sobrenome`=?,`nascimento`=?, `sexo`=?, `imagem`="default.png", `status`=0, `cadastro`=now(), `nivel`=0');
										if($inserir->execute(array($emailInsert,$senhaInsert,$nome,$sobrenome,$nascimento,$sexo))){
											header('Location: ./');
										}
								}
							}
							echo '</h3>';
	}
?>
<blockquote><i>Atenção: Não esqueça de ler às regras de privacidade. <a href="politica.php">Clique aqui para visualizar</a></i></blockquote>
<form id="cadastro" name="cadastro" style="width:97%" action="" method="POST">
  <fieldset>
    <legend>Dados Pessoais</legend>
    <table width="90%" border="0">
  	  <tr>
  	    <td  class="aligntxtcad"><label for="sobrenome">Nome</label></td>
  	    <td ><input type="text" name="sobrenome" size="50" required autofocus></td>
      </tr>
       <tr>
  	    <td class="aligntxtcad"><label for="sexo">Sexo:</label></td>
  	    <td ><select name="sexo" required><option name="sexo" value="masculino" selected>Masculino</option>
        <option name="sexo" value="feminino">Feminino</option></select> </td>
      </tr>
          <tr>
        <td class="aligntxtcad"><label for="email">E-mail:</label></td>
  	    <td><input type="email" name="email" size="50" required></td>
        <tr>
        <td class="aligntxtcad"><label for="nascimento">Data de Nascimento:</label></td>
        <td> <input type="date" name="nascimento" size="10" required></td>
      </tr>
    </table></fieldset><br />
    <fieldset>
    <legend>Conta</legend>
    <table width="90%" border="0">
      <tr>
        <td class="aligntxtcad"><label for="nome">Nome de Exibi&ccedil;&atilde;o:</label></td>
        <td><input type="text" name="nome" size="25" required></td>
      </tr>
      <tr>
        <td class="aligntxtcad"><label for="senha">Senha:</label></td>
        <td><input type="password" name="senha" size="20" required></td>
      </tr>
  </table>

    </fieldset>
    <h6 align="right">Todos os campos são obrigatórios.</h6>
      <input class="submit" type="submit" value="Enviar" name="enviar" >
      <input type="reset" name="limpardados" value="Limpar">
</form>
<br></div>
</body>
</html>