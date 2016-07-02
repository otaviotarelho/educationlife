<?php include('includes/header.php');?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>EducationLife - Seus dados cadastrais</title>
<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery.js" type="text/javascript"></script>
<!--[if lte IE 8]>
<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
</head>

<body> 
	<?php include('includes/toolbar.php'); ?> 
	<?php
	if(isset($_GET['perfil']) and $_GET['perfil']=='CROP'){
	include('php/recorte.php');}
	else if(isset($_GET['inst']) and $_GET['inst']=='CROP2'):
	$cid=$_GET['cid'];
	include('php/recorte2.php');
	endif;
	?>
       	<div id="dados">
         <?php if(isset($_GET['status'])){
			 	$status=$_GET['status'];
				if($status==1){
					echo"<div width='90%' style='background-color:#ABFCA9; border:1; border-color:#47F554; padding-left:10px; padding-bottom:10px; padding-top:10px;'>Dados alterados com sucesso.</div>";
				}
				else if($status==2){
					echo"<div width='90%' style='background-color:#FA9A89; border:1; border-color:#F25C37; padding-left:10px; padding-bottom:10px; padding-top:10px;'>Erro ao alterar dados.</div>";
				}else if($status==10){
					echo"<div width='90%' style='background-color:#ABFCA9; border:1; border-color:#47F554; padding-left:10px; padding-bottom:10px; padding-top:10px;'>Senha alterada com sucesso. Relogue <a href='?sair=true'>agora</a>!</div>";
				}
				else if($status==11){
					echo"<div width='90%' style='background-color:#FA9A89; border:1; border-color:#F25C37; padding-left:10px; padding-bottom:10px; padding-top:10px;'>Não foi possivel alterar a sua senha.</div>";
				}
				else if($status==12){
					echo"<div width='90%' style='background-color:#FA9A89; border:1; border-color:#F25C37; padding-left:10px; padding-bottom:10px; padding-top:10px;'>A senha atual não confere com a senha digita no campo.</div>";
				}
				else if($status==13){
					echo"<div width='90%' style='background-color:#FA9A89; border:1; border-color:#F25C37; padding-left:10px; padding-bottom:10px; padding-top:10px;'>Usuário inválido no banco de dados.</div>";
				}
				else if($status==30){
					echo"<div width='90%' style='background-color:#FA9A89; border:1; border-color:#F25C37; padding-left:10px; padding-bottom:10px; padding-top:10px;'>Nenhuma instituição. <a href='dados.php'>Voltar</a></div>";
				}
				else if($status==31){
					echo"<div width='90%' style='background-color:#ABFCA9; border:1; border-color:#47F554; padding-left:10px; padding-bottom:10px; padding-top:10px;'>Dados da instituição alterados com sucesso.</div>";
				}
				else if($status==40){
					echo"<div width='90%' style='background-color:#FA9A89; border:1; border-color:#F25C37; padding-left:10px; padding-bottom:10px; padding-top:10px;'>A imagem não apresenta tipo, ou seu tipo é invalido. Altere-a! <a href='dados.php'>Voltar</a></div>";
				}
				else{
					echo"<div width='90%' style='background-color:#FA9A89; border:1; border-color:#F25C37; padding-left:10px; padding-bottom:10px; padding-top:10px;'>Erro Desconhecido.</div>";
				}
		 }else{
		 }
		 ?>
         
         <h3>Seus dados cadastrais.</h3><p>Você pode gerenciar suas informações de exibição através desse painel de controle. Todas as suas informações salvas serão criptografadas e só poderão ser lidas através do seu navegador, dando-lhe maior segurança em seus dados.</p>
          <?php 
		  	$cadastrais=DB::getConn()->prepare("SELECT * FROM usuarios WHERE id=?");
			$cadastrais->execute(array($iddasessao));
			if($cadastrais->rowCount()==0){
				header("location: ./");
			}else{
				$dados2=$cadastrais->fetch(PDO::FETCH_ASSOC);
			}
		  ?>
       	  <form action="php/alterdados.php?id=<?php echo $iddasessao;?>" method="post" enctype="multipart/form-data" name="attdados"><fieldset>
   	        <legend>Informações Pessoais</legend>
       	    <table width="80%" border="0">
       	      <tr>
       	        <td><label for="Nome">Nome:</label></td>
       	        <td><input type="text" name="sobrenome" id="sobrenome" value="<?php echo $dados2['sobrenome']; ?>" required></td>
   	          </tr>
       	      <tr>
       	        <td><label for="Nome de Exibi&ccedil;&atilde;o">Nome de Exibição:</label></td>
       	        <td><input type="text" name="nome" id="nome" value="<?php echo $dados2['nome']; ?>" required></td>
   	          </tr>
       	      <tr>
       	        <td>Data de Nascimento:</td>
       	        <td><input type="date" name="nascimento" id="nascimento" value="<?php 
				$timestamp=$dados2['nascimento'];
				echo date($timestamp); ?>" required></td>
   	          </tr>
       	      <tr>
       	        <td>&nbsp;</td>
       	        <td>&nbsp;</td>
   	          </tr>
       	      <tr>
       	        <td><input type="submit" name="salvar" id="salvar" value="Salvar Alterações" required></td>
       	        <td>&nbsp;</td>
   	          </tr>
   	        </table>
       	  </fieldset></form>
       	  <form name="form1" method="post" action="php/altersenha.php?id=<?php echo $iddasessao;?>">
       	    <fieldset>
   	          <legend>Alteração de senha</legend>
              <table width="80%" border="0">
                <tr>
                  <td width="18%">Senha:</td>
                  <td width="82%">
                  <input type="password" name="senhaatual" required></td>
                </tr>
                <tr>
                  <td>Nova senha:</td>
                  <td>
                  <input type="password" name="novasenha" required></td>
                </tr>
                <tr>
                  <td><input type="submit" name="altersenha" value="Alterar Senha"></td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </fieldset>
       	  </form>
          <!--Upload foto perfil-->
          
          <fieldset><legend>Troca de imagem de perfil</legend>
          <table width="80%" border="0"><form name="upload" enctype="multipart/form-data" method="post" action="php/file.php">
  <tr>
    <td width="12%">Upload:</td>
    <td width="88%"><input type="file" name="image" required>
    <input type="hidden" name="id" value="<?php echo $iddasessao;?>">
    <input type="hidden" name="antiga" value="<?php echo $user_imagem;?>">
    <input type="hidden" name="upload" value="perfil"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="enviar" value="OK!"></form> </td>
  </tr></table>
          </fieldset>
          <!--seleção de instituição-->
          <fieldset>
          <legend>Instituições</legend>           
         <?php $insts=DB::getConn()->prepare("SELECT * FROM instituicao WHERE usermaster=?");
		 $insts->execute(array($iddasessao));
		 if($insts->rowCount()==1){
			 echo'
           <form name="novo" method="post" action="dadosid.php?status=0">
           <table width="80%" border="0">
             <tr>
               <td width="12%">Selecione:</td>
               <td width="88%"><label for="select"></label>
                 <select name="select" id="select">';
				 while($inst=$insts->fetch(PDO::FETCH_ASSOC)){
					  echo"<option value='".$inst['id']."'>".$inst['nome']."</option>";				  
				  } ;
				 echo'</select>
               <input type="submit" name="ok" value="OK"></td>
             </tr>
           </table></form>
         ';
		 }else{
			 echo"Nenhuma instituição";
		 }?>
         
         
          </fieldset>
         <br>
</div>
</body>
</html>