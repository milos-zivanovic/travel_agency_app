<?php
	if($result == 'Registrovani korisnik') {
		$_SESSION['user'] = $user;
		$_SESSION['role'] = $result;
		header("Location: welcome.php");
	} else if($result == 'Radnik agencije') {
		$_SESSION['user'] = $user;
		$_SESSION['role'] = $result;
		header("Location: admin_welcome.php");
	} else if($result == 'Sef agencije') {
		$_SESSION['user'] = $user;
		$_SESSION['role'] = $result;
		header("Location: admin_welcome.php");
	} else {
		login_form($title);
		echo "<br/><div class='alert alert-danger' role='alert'>Netačna kombinacija korisničkog imena i lozinke.</div>";
	}
?>