<?php
	session_start();
	include_once("functions/functions.php");
	$link = connection();
	$title = "Dodajte aranžman";
	head($title);
?>

<body>
	<div class="div1">
<?php
		if(isset($_SESSION['user']) && !empty($_SESSION['user']) && ((strcmp($_SESSION['role'], 'Radnik agencije') == 0) || (strcmp($_SESSION['role'], 'Sef agencije') == 0))) {
			navigation('Dodajte aranžman');
			
			if(isset($_POST['submit'])) {
				if(isset($_POST['type']) && !empty($_POST['type']) && isset($_POST['country']) && !empty($_POST['country']) &&
					isset($_POST['destination']) && !empty($_POST['destination'])) {
						$type = mysqli_real_escape_string($link, $_POST['type']);
						$country = mysqli_real_escape_string($link, htmlentities(trim($_POST['country'])));
						$destination = mysqli_real_escape_string($link, htmlentities(trim($_POST['destination'])));
						
						$sql = "INSERT INTO `arrangements`(`type`, `country`, `destination`) 
								VALUES ('". $type ."', '". $country ."', '". $destination ."')";
						$query = mysqli_query($link, $sql);
						$num_rows = mysqli_affected_rows($link);
						if($num_rows == 0) {
							echo "<div class='alert alert-danger' role='alert'>Došlo je do greške. Molimo Vas pokušajte ponovo.</div>";
							add_arrangement();
						} else {
							echo "<div class='alert alert-success' role='alert'>Aranžman je uspešno dodat. Spisak svih aranžmana pogledajte <a href='arrangements.php'>ovde</a>.</div>";
						}
						
					} else {
						echo "<div class='alert alert-danger' role='alert'>Molimo Vas popunite sva polja</div>";
						add_arrangement();
					}
			
			} else {
				add_arrangement();
			}
			
			
		} else {
			die("<div class='alert alert-danger' role='alert'>Nemate pristup ovoj stranici. Molimo Vas <a href='index.php'>ulogujte se</a>.</div>");
		}
?>
	</div>
</body>
</html>