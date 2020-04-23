<?php
	session_start();
	include_once("functions/functions.php");
	$link = connection();
	$title = "Početna";
	head($title);
?>

<body>
	<div class="div1">
<?php
		if(isset($_SESSION['user']) && !empty($_SESSION['user']) && ((strcmp($_SESSION['role'], 'Radnik agencije') == 0) || (strcmp($_SESSION['role'], 'Sef agencije') == 0))) {
			navigation('Pocetna');
			echo "<h2>Dobrodošli, " . $_SESSION['user'] . "(<a href='logout.php'>logout</a>)</h2>";
		} else {
			die("<div class='alert alert-danger' role='alert'>Nemate pristup ovoj stranici. Molimo Vas <a href='index.php'>ulogujte se</a>.</div>");
		}
?>
	</div>
</body>
</html>