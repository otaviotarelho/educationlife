<? 			$e_meu_amigo=DB::getConn()->prepare("SELECT * FROM `amizade` WHERE (de=?) or (para=?) and status=0");
			$e_meu_amigo->execute(array($iddasessao, $iddassesao));
			$num_not=$e_meu_amigo->rowCount();
?>