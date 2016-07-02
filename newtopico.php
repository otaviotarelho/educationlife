<?php include('includes/header.php');?>
<?php include('includes/toolbar.php'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>EducationLife -Adicionar Tópico</title>
<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 8]>
<script src="js/html5.js" type="text/javascript"></script>
<![endif]-->
</head>
<script src="js/nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<body>
	<?php
		if(isset($_GET['cid']) and isset($iddasessao)){
			$comunidade=$_GET['cid'];
			$verificando=DB::getConn()->prepare('SELECT * FROM membros WHERE de=? and para=?');
			$verificando->execute(array($iddasessao,$comunidade));
			if($verificando->rowCount()==0){
				$verificando2=DB::getConn()->prepare('SELECT * FROM instituicao WHERE usermaster=?');
				$verificando2->execute(array($iddasessao));
				if($verificando2->rowCount()==0){
					header("location: inst.php?cid=$comunidade");
				}else{
				
				}				
			}else{
				
			}		
		}
		else{
			header("location: ./");
		}
		if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST'){
			$nome=$_POST['nome'];
			$tipo=$_POST['tipo'];
			$descricao=$_POST['descricao'];
			$conteudo=$_POST['conteudo'];
			if(isset($_SESSION['last_request'])&& $_SESSION['last_request']==$conteudo){
				echo'Erro - Você já enviou esse conteúdo anteriormente.';
			}else{	
			$_SESSION['last_request']=$conteudo;
			$INSERINDO=DB::getConn()->prepare('INSERT INTO topicos SET nome=?,id_inst=?,id_autor=?,conteudo=?,descricao=?,tipo=?');
			$INSERINDO->execute(array($nome,$comunidade,$iddasessao,$conteudo,$descricao,$tipo));
			header("location: inst.php?cid=$comunidade");
			}						
			}
		
	?>
    <div id="amigos">
   	<h3>Nova Postagem</h3>
    <form name="form1" method="post" action="">
      <table width="80%" border="0">
        <tr>
          <td width="22%">Nome da Postagem:</td>
          <td colspan="3"><label for="nome"></label>
            <input name="nome" type="text" id="nome" size="30" maxlength="30" required>
          </td>
        </tr>
        <tr>
          <td>Tipo de Postagem:</td>
          <td colspan="3"><label for="tipo"></label>
            <select name="tipo" id="tipo" required>
            <option value="postagem" >Novo Tópico</option>
            <option value="Atividade">Atividade</option>
            <option value="curiosidades">Curiosidade</option>
          </select></td>
        </tr>
        <tr>
          <td>Descrição:</td>
          <td colspan="3"><label for="textfield"></label>
          <input name="descricao" type="text" id="textfield" size="50" maxlength="150" equired></td>
        </tr>
        <tr>
          <td>Conteúdo:</td>
          <td colspan="3"><textarea name="conteudo" cols="70" rows="10" id="conteudo"></textarea></td>
        </tr>
        <tr>
          <td><input type="submit" name="button" id="button" value="Enviar">
          <input type="reset" name="button2" id="button2" value="Redefinir"></td>
          <td width="6%">&nbsp;</td>
          <td width="10%">&nbsp;</td>
          <td width="62%" align="right">&nbsp;</td>
        </tr>
      </table>
    </form>
    <br>
    <br>    
    </div>
</body>
</html>