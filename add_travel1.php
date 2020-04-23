<?php
	session_start();
	include_once("functions/functions.php");
	$link = connection();
	$title = "Dodajte putovanje";
	head($title);
?>

<body>
	<div class="div1">

	<!-- stampaj spisak svih aranzmana linkovanih ka drugoj strani, sa dodatkom njihovog id-a -->
	
<?php
	if(isset($_SESSION['user']) && !empty($_SESSION['user']) && ((strcmp($_SESSION['role'], 'Radnik agencije') == 0) || (strcmp($_SESSION['role'], 'Sef agencije') == 0))) {
			navigation('Dodajte putovanje');
			$sql = "SELECT * FROM `arrangements`";
			$query = mysqli_query($link, $sql);
			while($results = mysqli_fetch_array($query)) { 
?>
				<a href="add_travel2.php?arrangement_id=<?=$results['arrangement_id']?>">
					<div class="oglas"> 
						<h2><?=$results['type']?></h2>
						<h4>Zemlja: <?=$results['country']?></h4>
						<h4>Destinacija:<?=$results['destination']?></h4>
					</div>
				</a>
<?php 
			}
	} else {
		die("<div class='alert alert-danger' role='alert'>Nemate pristup ovoj stranici. Molimo Vas <a href='index.php'>ulogujte se</a>.</div>");
	}
?>
	
	</div>
</body>
</html>