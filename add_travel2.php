<?php
	session_start();
	include_once("functions/functions.php");
	$link = connection();
	$title = "Dodajte putovanje";
	head($title);
?>

<body>
	<div class="div1">
<?php
		if(isset($_SESSION['user']) && !empty($_SESSION['user']) && ((strcmp($_SESSION['role'], 'Radnik agencije') == 0) 
		|| (strcmp($_SESSION['role'], 'Sef agencije') == 0))) {
			navigation('Dodajte putovanje');
			if(isset($_GET['arrangement_id'])) {
				$arrangement_id = $_GET['arrangement_id'];
			}
			if(isset($_POST['submit'])) {
				if(isset($_POST['hotel']) && !empty($_POST['hotel']) &&
					isset($_POST['category']) && is_numeric($_POST['category']) && isset($_POST['person_num']) && is_numeric($_POST['person_num']) &&
					isset($_POST['days/nights']) && is_numeric($_POST['days/nights']) && isset($_POST['days_num']) && is_numeric($_POST['days_num']) &&
					isset($_POST['begin']) && !empty($_POST['begin']) && isset($_POST['end']) && !empty($_POST['end']) &&
					isset($_POST['transport_type']) && !empty($_POST['transport_type']) &&
					isset($_POST['food_type']) && isset($_POST['price']) && is_numeric($_POST['price']) &&
					isset($_POST['arrangement_id']) && is_numeric($_POST['arrangement_id']))  {
						
						$hotel = mysqli_real_escape_string($link, htmlentities(trim($_POST['hotel'])));
						$category = mysqli_real_escape_string($link, $_POST['category']);
						$person_num = mysqli_real_escape_string($link, $_POST['person_num']);
						$days_nights = mysqli_real_escape_string($link, $_POST['days/nights']);
						$days_num = mysqli_real_escape_string($link, $_POST['days_num']);
						$begin = mysqli_real_escape_string($link, $_POST['begin']);
						$end = mysqli_real_escape_string($link, $_POST['end']);
						$transport_type = mysqli_real_escape_string($link, htmlentities(trim($_POST['transport_type'])));
						$food_type = mysqli_real_escape_string($link, $_POST['food_type']);
						$price = mysqli_real_escape_string($link, $_POST['price']);
						$remark = mysqli_real_escape_string($link, htmlentities(trim($_POST['remark'])));
						$web_site = mysqli_real_escape_string($link, htmlentities(trim($_POST['web_site'])));
						$arrangement_id = mysqli_real_escape_string($link, $_POST['arrangement_id']);
						$author = $_SESSION['user'];
						
						if($person_num > 0) {
								if($days_nights > 0) {
									if($days_num > 0) {
											if($begin < $end) {
											
												$begin = transform_date($begin);
												$end = transform_date($end);
												
												$sql1 = "INSERT INTO `travels`(`arrangement_id`, `days/nights`, `transport_type`, `food_type`, `price`, `days_num`)
														VALUES ('". $arrangement_id ."', '". $days_nights ."', '". $transport_type ."', '". $food_type ."', '". $price ."', '". $days_num ."')";      
												
												$sql2 = "INSERT INTO `travel_infos`(`begin`, `end`, `author`)
														VALUES ('". $begin ."', '". $end ."', '". $author ."')";
															
												$sql3 = "INSERT INTO `hotel`(`name`, `category`, `person_num`, `remark`, `web_site`) 
														VALUES ('". $hotel ."', '". $category ."', '". $person_num ."', '". $remark ."', '". $web_site ."')";
														
														
												if(mysqli_query($link, $sql1) && mysqli_query($link, $sql2) && mysqli_query($link, $sql3)) {
													echo "<div class='alert alert-success' role='alert'>Putovanje je uspešno dodato. Spisak putovanja 
														pogledajte <a href='travels.php'>ovde</a>.</div>";
												
												
												
												
												} else {
													echo "<div class='alert alert-danger' role='alert'>Došlo je do greške. Molimo Vas pokušajte ponovo</div>";
													add_travel($arrangement_id);
												}
												
											
											} else {
												echo "<div class='alert alert-danger' role='alert'>Kraj putovanja ne može doći pre početka.
														Proverite unete podatke.</div>";
												add_travel($arrangement_id);
											}
											
																			
									} else {
										echo "<div class='alert alert-danger' role='alert'>Broj dana mora biti veći od 0.</div>";
										add_travel($arrangement_id);
									}
								} else {
									echo "<div class='alert alert-danger' role='alert'>Broj dana/noći mora biti veći od 0.</div>";
									add_travel($arrangement_id);
								}
						} else {
							echo "<div class='alert alert-danger' role='alert'>Broj osoba u sobi mora biti veći od 0.</div>";
							add_travel($arrangement_id);
						}			
					} else {
						echo "<div class='alert alert-danger' role='alert'>Molimo Vas unesite sve podatke u ispravnom formatu.</div>";
						add_travel($arrangement_id);
					}
			} else {
				add_travel($arrangement_id);
			}
		
		} else {
			die("<div class='alert alert-danger' role='alert'>Nemate pristup ovoj stranici. Molimo Vas <a href='index.php'>ulogujte se</a>.</div>");
		}
?>
	</div>
</body>
</html>