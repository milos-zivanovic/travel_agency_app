<?php
	session_start();
	include_once("functions/functions.php");
	$link = connection();
	include_once('includes/check_user.inc.php');
	head('Dobrodošli');
?>

<body>
	<div class="div1">
	
<?php
		if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
			navigation('Pocetna');
			echo "<h2>Dobrodošli, " . $_SESSION['user'] . "(<a href='logout.php'>logout</a>)</h2>";
		} else {
			die("<div class='alert alert-danger' role='alert'>Nemate pristup ovoj stranici. Molimo Vas <a href='index.php'>ulogujte se</a>.</div>");
		}
?>
	</div>
</body>
</html>