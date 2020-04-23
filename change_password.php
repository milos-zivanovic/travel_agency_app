<?php
	session_start();
	include_once("functions/functions.php");
	$link = connection();
	$title = "Promena lozinke";
	head($title);
?>



<body>
	<div class="div1">
		<div class="form1">
<?php
			if(isset($_POST['submit'])) {
				if(isset($_POST['user']) && !empty($_POST['user'])  &&  isset($_POST['password']) && !empty($_POST['password'])
				&&  isset($_POST['new_password']) && !empty($_POST['new_password'])) {
					$user = mysqli_real_escape_string($link, htmlentities(trim($_POST['user'])));
					$password = md5(mysqli_real_escape_string($link, htmlentities(trim($_POST['password']))));
					$new_password = md5(mysqli_real_escape_string($link, htmlentities(trim($_POST['new_password']))));
					
					if(strlen($user)>4) { 
						if(strlen($password)>6 && strlen($new_password)>6) {
							if(strcmp($password, $new_password) == 0) {
								login_form($title);
								echo "<div class='alert alert-danger' role='alert'>Stara i nova lozinka su iste.</div>";
							} else {
								$sql = "SELECT * FROM `user` WHERE `username` = '". $user ."' AND `password` = '". $password ."'";
								$query = mysqli_query($link, $sql);
								$num_rows = mysqli_num_rows($query);
								
								if($num_rows == 0) {
									login_form($title);
									echo "<div class='alert alert-danger' role='alert'>Korisnicko ime ili lozinka su netacni.</div>";
								} else {
									$sql1 = "UPDATE `user` SET `password`='". $new_password ."' WHERE `username` = '". $user ."' AND `password` = '". $password ."'";
									$query1 = mysqli_query($link, $sql1);
									if(mysqli_affected_rows($link) == 0) {
										login_form($title);
										echo "<div class='alert alert-danger' role='alert'>Doslo je do greske. Molimo Vas pokusajte ponovo.</div>";
									} else {
										echo "<div class='alert alert-success' role='alert'>Lozinka promenjena. Koristite novu lozinku da se <a href='index.php'>ulogujete</a></div>";
									
									}
								
								}
							}
						
						} else {
							login_form($title);
							echo "<div class='alert alert-danger' role='alert'>Lozinke moraju biti odgovarajuce duzine.</div>";
						}
					} else {
						login_form($title);
						echo "<div class='alert alert-danger' role='alert'>Korisnicko ime mora biti odgovarajuce duzine.</div>";	
					}
					
				} else {
					login_form($title);
					echo "<div class='alert alert-danger' role='alert'>Molimo Vas popunite sva polja.</div>";
				}
			
			} else {
				login_form($title);
?>
				<a href="send_mail.php"><label>Zaboravljena lozinka</label></a><br/>
				<a href="index.php"><label>Ulogujte se</label></a><br/>
				<a href="register.php"><label>Registrujte se</label></a><br/>
<?php
			}
?>
		</div>
	</div>
</body>
</html>