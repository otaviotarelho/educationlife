	<?php 
		$selamigo=DB::getConn()->prepare("SELECT i.id, i.imagem, i.nome FROM `instituicao` i INNER JOIN `membros` m ON ((m.para=i.id AND m.de=? AND m.status=1) or i.usermaster=?)");
		$selamigo->execute(array($idExtrangeiro,$idExtrangeiro));
		$numamigos2=$selamigo->rowCount();
	?>
    
    
  