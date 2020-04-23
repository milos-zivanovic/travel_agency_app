<?php
	session_start();
	include_once("functions/functions.php");
	$link = connection();
	$title = "Početna";
	head($title);
?>

<body>
	<div class="div1">
		<div class="form1">
<?php
			if(isset($_POST['submit'])) {
				if(isset($_POST['user']) && !empty($_POST['user'])  &&  isset($_POST['password']) && !empty($_POST['password'])) {
					$user = $_POST['user'];
					$password = md5($_POST['password']);
					$result = login_check($link, $user, $password);
					include_once('includes/include.inc.php');
					
				} else {
					login_form($title);
					echo "<br/><div class='alert alert-danger' role='alert'>Molimo Vas popunite sva polja.</div>";
				}
				
			} else {
				login_form($title);
			}
?>
			<br/>
			<a href="send_mail.php"><label>Zaboravljena lozinka</label></a>
			<a href="change_password.php"><label>Promeni lozinku</label></a>
			<a href="register.php"><label>Registrujte se</label></a>
		</div>
	</div>
</body>
</html>