<?php
	session_start();
	include_once("functions/functions.php");
	$link = connection();

	head('Registrujte se');
?>

<body>
	<div class="div1">
		<div class="form1">
<?php
			if(isset($_POST['submit'])) {
				if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['surname']) && !empty($_POST['surname']) &&
					isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password']) &&
					isset($_POST['repeat_password']) && !empty($_POST['repeat_password']) && isset($_POST['address']) && !empty($_POST['address']) &&
					isset($_POST['phone']) && !empty($_POST['phone']) && is_numeric($_POST['phone']) && isset($_POST['email']) && !empty($_POST['email'])) {
					
					$name = htmlentities(trim($_POST['name']));
					$surname = htmlentities(trim($_POST['surname']));
					$username = htmlentities(trim($_POST['username']));
					$password = htmlentities(trim($_POST['password']));
					$repeat_password = htmlentities(trim($_POST['repeat_password']));
					$address = htmlentities(trim($_POST['address']));
					$phone = htmlentities(trim($_POST['phone']));
					$email = htmlentities(trim($_POST['email']));

					if(strlen($name) > 4 && strlen($surname) > 4) {
						if(strlen($password) > 6 && strlen($repeat_password) > 6) {
							if(strcmp($password, $repeat_password) == 0) {
								$password = md5($password);
								$user_created = new_user($link, $name, $surname, $username, $password, $address, $phone, $email);
								if($user_created == true) {
									$_SESSION['user'] = $username;
									header("Location: welcome.php");
									
								} else {
									register_form();
									echo "<br/><div class='alert alert-danger' role='alert'>Došlo je do greške. Pokušajte ponovo.</div>";
								}
							
							} else {
								register_form();
								echo "<br/><div class='alert alert-danger' role='alert'>Lozinke moraju biti iste.</div>";
							}
							
						} else {
							register_form();
							echo "<br/><div class='alert alert-danger' role='alert'>Lozinke moraju imati minimum 6 karaktera.</div>";
						}
					
					} else {
						register_form();
						echo "<br/><div class='alert alert-danger' role='alert'>Ime i prezime moraju imati minimum 4 karaktera.</div>";
					}
					
				} else {
					register_form();
					echo "<br/><div class='alert alert-danger' role='alert'>Molimo Vas popunite sva polja.</div>";
				}
				
			} else {
				register_form();
			}
?>
			<br/>
			<a href="index.php"><label>Ulogujte se</label></a>
		</div>
	</div>
</body>
</html>