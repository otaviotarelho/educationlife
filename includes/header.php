<?php 
	include('./classes/DB.class.php');
	include('./classes/Login.class.php');
	$objLogin = new Login;
    if(!$objLogin->logado()){
	include('login.php');
	exit();
	}
    if(isset($_GET['sair'])){
	$objLogin->sair();
	header('Location: ./');
	}
	$idExtrangeiro=(isset($_GET['uid'])? (int)$_GET['uid']:$_SESSION['edlife_uid']);
	$idExtrangeiroInst=(isset($_GET['cid']));
	$iddasessao=$_SESSION['edlife_uid'];
	$dados = $objLogin->getDados($iddasessao);
	if(is_null($dados)){
		header('location: ./');
		exit();
	} else{
		extract($dados,EXTR_PREFIX_ALL,'user');
	}
	$seleimage=DB::getConn()->prepare("SELECT imagem FROM usuarios WHERE `id` =? LIMIT 1");
	$seleimage->execute(array($iddasessao));
	$resultimagem=$seleimage->fetch(PDO::FETCH_ASSOC);
	$user_imagem=$resultimagem['imagem'];
	$user_fullname = $user_nome.' '.$user_sobrenome;
?>
