<?php
	function head($title) {
?>
		<!DOCTYPE html>
		<html lang="sr">
		<head>
			<meta charset="utf-8">
			<title><?=$title?></title>
			<link rel="stylesheet" type="text/css" href="bootstrap + jquery/css/bootstrap.css">
		</head>
<?php
	}

	function connection() {
		if(!$link = mysqli_connect("localhost", "root", "", "rezervacija_putovanja")) {
			die("Neuspela konekcija na bazu podataka");
		}
		return $link;
	}

	function login_form($title) {
?>
		<form action="" method="post">
			<h2>Popunite polja</h2><br/>
			<label>Korisnik</label>
			<input type="text" id="user" name="user" maxlength="30" placeholder="Unesite ime..." autofocus><br/><br/>
			<label>Lozinka</label>
			<input type="password" id="password" name="password" maxlength="30" placeholder="Unesite lozinku..."><br/><br/>
<?php		
			if(strcmp($title, 'Promena lozinke') == 0) {
				echo '<label>Nova lozinka</label>
					<input type="password" id="new_password" name="new_password" maxlength="30" placeholder="Unesite novu lozinku..."><br/><br/>';
				echo '<input type="submit" id="submit" name="submit" class="btn btn-primary" value="Promeni lozinku"><br/><br/>';
			} else {
				echo '<input type="submit" id="submit" name="submit" class="btn btn-primary" value="Ulogujte se"><br/><br/>';
			}
			
		echo '</form>';
	}
	
	function register_form() {
?>
		<form action="" method="post">
			<h2>Popunite polja</h2><br/>
			<label>Ime</label>
			<input type="text" id="name" name="name" maxlength="30" placeholder="Unesite ime..." autofocus><br/><br/>
			<label>Prezime</label>
			<input type="text" id="surname" name="surname" maxlength="30" placeholder="Unesite prezime..." ><br/><br/>
			<label>Korisničko ime</label>
			<input type="text" id="username" name="username" maxlength="30" placeholder="Unesite korisničko ime..." ><br/><br/>
			<label>Lozinka</label>
			<input type="password" id="password" name="password" maxlength="30" placeholder="Unesite lozinku..."><br/><br/>
			<label>Ponovljena lozinka</label>
			<input type="password" id="repeat_password" name="repeat_password" maxlength="30" placeholder="Unesite istu lozinku..."><br/><br/>
			<label>Adresa</label>
			<input type="text" id="address" name="address" maxlength="50" placeholder="Unesite adresu..."><br/><br/>
			<label>Kontakt telefon</label>
			<input type="tel" id="phone" name="phone" maxlength="10" placeholder="Unesite kontakt telefon..."><br/><br/>
			<label>Email</label>
			<input type="email" id="email" name="email" maxlength="30" placeholder="Unesite email..."><br/><br/>
			<input type="submit" id="submit" name="submit" class="btn btn-primary"value="Registrujte se">
		</form>
<?php
	}
	
	function change_password_form() {
?>
		<form action="" method="post">
			<h2>Unesite e-mail</h2><br/>
			<label>E-mail adresa: </label><br/>
			<input type="email" id="email" name="email" maxlength="30" placeholder="Unesite e-mail adresu..." autofocus><br/><br/>
			<input type="submit" id="submit" name="submit" class="btn btn-primary" value="Posalji e-mail">
		</form>
<?php
	}
	
	function new_user($link, $name, $surname, $username, $password, $address, $phone, $email) {
		$sql1 = "INSERT INTO `user`(`username`, `password`) VALUES ('". $username ."', '". $password ."')";
		$sql2 = "INSERT INTO `user_info`(`name`, `surname`, `address`, `phone`, `email`) 
					VALUES ('". $name ."', '". $surname ."', '". $address ."', '". $phone ."', '". $email ."')";

		$user_created = mysqli_query($link, $sql1);
		$user_info_created = mysqli_query($link, $sql2);
		if($user_created && $user_info_created) {
			return true;
		} else {
			return false;
		}
	}
	
	function login_check($link, $user, $password) {
		$sql = "SELECT * FROM `user` WHERE `username` = '". $user ."' AND `password` = '". $password ."'";
		$query = mysqli_query($link, $sql);
		$num_rows = mysqli_num_rows($query);
		$result = mysqli_fetch_array($query);
		$role = $result['role']; 
		if($num_rows == 0) {
			return false;
		} else {
			if (strcmp($role, 'Registrovani korisnik') == 0) {
				return 'Registrovani korisnik';
			} else if (strcmp($role, 'Radnik agencije') == 0){
				return 'Radnik agencije';
			} else if(strcmp($role, 'Sef agencije') == 0) {
				return 'Sef agencije';
			} else {
				return false;
			}
		}
	}
	
	function generate_temp_password($length = 12) {
		$characters = 'sdf696789S7DF89S7DhjkF98798ds7fa8s7dkk98vvf7987F987Sol8D97F89S7DF98798tttjf7987sd98f798F7SoDF798d7987sdfg';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function navigation($title) {
		echo'<div class="header">
			<ul class="nav nav-pills">';
				tab($title, 'Pocetna', 'welcome.php');
				tab($title, 'Aranzmani', 'arrangements.php');
				tab($title, 'Putovanja', 'travels.php');
				tab($title, 'Logout', 'logout.php');
		echo'</ul>
		</div>';
	}
	
	function tab($title, $string, $link) {
		if(strcmp($title, $string) == 0) {
			echo '<li role="presentation" class="active"><a href="'. $link .'.php">'. $string .'</a></li>';
		} else {
			echo '<li role="presentation"><a href="'. $link .'">'. $string .'</a></li>';
		}
	}
	
	function add_travel($arrangement_id) {
?>
		<form class="form1" action="" method="post">
			<h2>Polja sa * su obavezna</h2><br/>
			<label>Naziv hotela*</label>
			<input type="text" name="hotel" placeholder="Unesite naziv hotela..." maxlength="100"><br/><br/>
			<label>Broj * hotela*</label>
			<select name="category">
				<option value="1">1*</option>
				<option value="2">2*</option>
				<option value="3">3*</option>
				<option value="4">4*</option>
				<option value="5">5*</option>
			</select><br/><br/>
			<label>Broj osoba u sobi*</label>
			<input type="number" name="person_num" placeholder="Maksimalan broj osoba u sobi..." > <br/><br/>
			<label>Hotel - napomene</label>
			<textarea name="remark" maxlength="150" cols="20" rows="3"></textarea> <br/><br/>
			<label>Web sajt hotela</label>
			<input type="text" name="web_site" placeholder="Web sajt hotela..." maxlength="50"><br/><br/>
			<label>Broj dana/noći*</label>
			<input type="number" name="days/nights" placeholder="Broj dana/noći..."><br/><br/>
			<label>Početak putovanja*</label>
			<input type="date" name="begin" placeholder="mm/dd/yyyy"><br/><br/>
			<label>Završetak putovanja*</label>
			<input type="date" name="end" placeholder="mm/dd/yyyy"><br/><br/>
			<label>Tip prevoza*</label>
			<input type="text" name="transport_type" placeholder="Unesite tip prevoza..." maxlength="50"><br/><br/>
			<label>Tip ishrane*</label>
			<select name="food_type">
				<option value="Doručak">Doručak</option>
				<option value="Polupansion">Polupansion</option>
				<option value="Pun pansion">Pun pansion</option>
			</select><br/><br/>
			<label>Cena putovanja*</label>
			<input type="number" name="price"><br/><br/>
			<label>Broj dana trajanja rezervacije*</label>
			<input type="number" name="days_num"><br/><br/>
			<input type="hidden" name="arrangement_id" value="<?=$arrangement_id?>">
			
			<input type="reset" name="reset" value="Obriši" class="btn btn-danger">
			<input type="submit" name="submit" value="Dodaj" class="btn btn-primary">
		</form>
<?php
	}
	
	function add_arrangement($arrangement_id) {
?>
		<form class="form1" action="" method="post">
			<h2>Popunite polja</h2><br/>
			<label>Tip aranžmana</label>
			<select name="type">
				<option value="Letovanje">Letovanje</option>
				<option value="Zimovanje">Zimovanje</option>
				<option value="Ture u Evropi">Ture u Evropi</option>
				<option value="Evropski gradovi">Evropski gradovi</option>
				<option value="Vikend u Evropi">Vikend u Evropi</option>
				<option value="Daleka putovanja po svetu">Daleka putovanja po svetu</option>
			</select> <br/><br/>
			<label>Zemlja</label>
			<input type="text" name="country" placeholder="Unesite državu..." maxlength="50"><br/><br/>
			<label>Destinacija</label>
			<input type="text" name="destination" maxlength="50" placeholder="Unesite destinaciju..."><br/><br/>
			<input type="hidden" name="arrangement_id" value="<?=$arrangement_id?>">
			<input type="reset" value="Obriši" name="reset" class="btn btn-danger">
			<input type="submit" value="Dodaj" name="submit" class="btn btn-primary">
		</form>
<?php
	}
	
	function transform_date($date) {
		$help = explode('/', $date);
									
		$date1[0] = $help[2];
		$date1[1] = $help[0];
		$date1[2] = $help[1];
		
		$date1 = implode('-', $date1);
		
		return $date1;									
	}
?>







