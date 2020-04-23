<?php	
	if(!isset($_SESSION['user']) && empty($_SESSION['user'])) {
		die("Za pristup ovoj stranici morate se ulogovati <a href='index.php'>ovde</a>.");
	}
?>