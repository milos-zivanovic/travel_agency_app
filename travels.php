<?php
	session_start();
	include_once("functions/functions.php");
	$link = connection();
	$title = "Putovanja";
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
				echo '<a href="add_travel1.php"><h3>Dodajte novo putovanje</h3></a>';
			}
?>
				<div class="oglas">  <!-- stampaj div sa jednim putovanjem	 -->
<?php
					$sql = "";
?>
				</div>
		</div>	
		
		<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
			BANNERS
		</div>
	</div>
</body>
</html>