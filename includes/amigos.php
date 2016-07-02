	<?php 
		$selamigo=DB::getConn()->prepare("SELECT u.id,u.nome, u.sobrenome, u.imagem FROM `usuarios` u INNER JOIN amizade a ON((((u.id=a.de) AND(a.para=?))OR ((u.id=a.para) AND(a.de=?))) AND a.status=1)");
		$selamigo->execute(array($idExtrangeiro,$idExtrangeiro));
		$numamigos=$selamigo->rowCount();
	?>
  