<?php include('includes/header.php');?> ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>EducationLife - Seus dados cadastrais</title>
<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 8]>
<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
</head>

<body> 	
		<?php include('includes/toolbar.php'); ?>
       	<div id="dados">
        <?php $instituicao=DB::getConn()->prepare("SELECT * FROM instituicao WHERE id=? and usermaster=?");
		extract($_POST);
		$status=$_GET['status'];
		$instituicao->execute(array($select, $iddasessao));
		if($instituicao->rowCount()==1){
			$inst=$instituicao->fetch(PDO::FETCH_ASSOC);
		}else{
			header("location: dados.php?status=30");
		}?>
        
         <?php if($status<>0){
				if($status==32){
					echo"<div width='90%' style='background-color:#ABFCA9; border:1; border-color:#47F554; padding-left:10px; padding-bottom:10px; padding-top:10px;'>Dados alterados com sucesso.</div>";
				}
				else{
					echo"<div width='90%' style='background-color:#FA9A89; border:1; border-color:#F25C37; padding-left:10px; padding-bottom:10px; padding-top:10px;'>Erro Desconhecido.</div>";
				}
		 }else{
		 }?>
         
         <h3>Altera&ccedil;&atilde;o de institui&ccedil;&atilde;o.<br>
</h3> 
         Voc&ecirc; est&aacute; prestes a alterar dados da sua institui&ccedil;&atilde;o. Tome cuidado. <a href="dados.php">Voltar</a><br/><br>
         <form action="php/instalter.php?id=<?php echo $inst['id'];?>&user=<?php echo $iddasessao;?>" method="post">
           <fieldset>
             <legend>Instituição</legend>
             <table width="80%" border="0">
  <tr>
    <td width="16%">Nome:</td>
    <td width="84%">
      <input name="nome" type="text" id="textfield" value="<?php echo $inst['nome'];?>" size="50" maxlength="30" required></td>
  </tr>
  <tr>
    <td>Descri&ccedil;&atilde;o:</td>
    <td>
      <input name="descricao" type="text" id="textfield2" value="<?php echo $inst['descricao'];?>" size="50" maxlength="140" required></td>
  </tr>
  <tr>
    <td>Nivel:</td>
    <td>
      <select name="nivel" id="nivel">
      <?php switch($inst['nivel']){
	  		case 1:
				echo'<option value="1" selected>Escola Pública</option>';
				echo'<option value="2">Escola Particular</option>';
				echo'<option value="3">Centro de Linguas</option>';
				break;
			case 2:
				echo'<option value="1">Escola Pública</option>';
				echo'<option value="2" selected>Escola Particular</option>';
				echo'<option value="3">Centro de Linguas</option>';
				break;
			case 3:
				echo'<option value="1">Escola Pública</option>';
				echo'<option value="2">Escola Particular</option>';
				echo'<option value="3" selected>Centro de Linguas</option>';
	  }?>
      </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="submit" name="button" id="button" value="Alterar"></td>
    <td>&nbsp;</td>
  </tr>
</table>
           </fieldset>
         </form>
         
          <fieldset><legend>Troca de imagem de perfil</legend>
          <table width="80%" border="0"><form name="upload" enctype="multipart/form-data" method="post" action="php/file.php">
  <tr>
    <td width="12%">Upload:</td>
    <td width="88%"><input type="file" name="image" required>
    <input type="hidden" name="id" value="<?php echo $inst['id'];?>">
    <input type="hidden" name="antiga" value="<?php echo $inst['imagem'];?>">
    <input type="hidden" name="upload" value="instituicao"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="enviar" value="OK!"></form> </td>
  </tr></table>
          </fieldset>
          <br>
          <br>
</div>
</body>
</html>