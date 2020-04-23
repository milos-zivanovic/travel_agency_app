<?php
	session_start();
	include_once("functions/functions.php");
	$link = connection();
	
	head('Privremena lozinka');
?>

<body>
	<div class="div1">	
		<div class="form1">
<?php
		if(isset($_POST['submit'])) {
			if(isset($_POST['email']) && !empty($_POST['email'])) {
				$email = mysqli_real_escape_string($link, trim($_POST['email']));
				$sql = "SELECT * FROM `user_info` WHERE `email` = '". $email ."'";
				$query = mysqli_query($link, $sql);
				$num_rows = mysqli_num_rows($query);
				if($num_rows == 0) {
					change_password_form();
					echo "<br/><div class='alert alert-danger' role='alert'>Nepoznata e-mail adresa. Pokušajte ponovo.</div>";
				} else {
					$temp_password = generate_temp_password();
					$subject = 'Rezervacija putovanja - <b>promena lozinke</b>';
					$message = 'Na našu e-mail adresu stigao je zahtev za promenu lozinke. <br/>
								Ukoliko niste zahtevali promenu lozinke, molimo vas ignorišite ovaj e-mail,
								a ukoliko jeste, Vaša nova privremena lozinka
								koju možete promeniti putem našeg sajta je: '. $temp_password .' 
								<br/>Hvala na poverenju.';
					$headers = 'From:z.milos93@yahoo.com';

					if(mail($email, $subject, $message, $headers)) {
						echo "<h2>E-mail je poslat</h2><br/><div class='alert alert-success' role='alert'>Molimo Vas proverite poštu. <a href='index.php'>Ulogujte se</a> sa novom lozinkom.</div>";
					} else {
						change_password_form();
						echo "<br/><div class='alert alert-danger' role='alert'>Došlo je do greške. Molimo Vas pokušajte ponovo.</div>";
					}
				
				}
			
			} else {
				change_password_form();
				echo "<br/><div class='alert alert-danger' role='alert'>Molimo Vas unesite e-mail.</div>";
			}
			
		} else {
			change_password_form();
?>
			<br/><br/><a href="index.php"><label>Ulogujte se</label></a><br/>
			<a href="register.php"><label>Registrujte se</label></a><br/>
<?php
		}
?>
		</div>
	</div>
</body>
</html>