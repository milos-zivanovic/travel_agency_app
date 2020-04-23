<?php
	session_start();
	include_once("functions/functions.php");
	$link = connection();
	$title = "Aranzmani";
	head($title);
?>

<body>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 div1">
<?php
		navigation($title);
?>
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 div2">
<?php
			if(strcmp($_SESSION['role'], 'Radnik agencije') == 0 || strcmp($_SESSION['role'], 'Sef agencije') == 0) {
				echo '<a href="add_arrangement.php"><h3>Dodajte nov aranžman</h3></a>';
			}
			
			$sql = "SELECT * FROM `arrangements`";
			$query = mysqli_query($link, $sql);
			while($results = mysqli_fetch_array($query)) { 
?>
				<div class="oglas">  <!-- stampaj div sa jednim aranzmanom	 -->
					<h2><?=$results['type']?></h2>
					<h4>Zemlja: <?=$results['country']?></h4>
					<h4>Destinacija:<?=$results['destination']?></h4>
				</div>
<?php 
			}
?>
		</div>	
		
		<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
			BANNERS
		</div>
	</div>
</body>
</html>