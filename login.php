<?php 
	
	require("../../config.php");
	
	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
		
	$signupEmailError = "";
	$signupEmail = "";
	
	//kas on �ldse olemas
	if (isset ($_POST["signupEmail"])) {
		
		// oli olemas, ehk keegi vajutas nuppu
		// kas oli t�hi
		if (empty ($_POST["signupEmail"])) {
			
			//oli t�esti t�hi
			$signupEmailError = "See v�li on kohustuslik";
			
		} else {
				
			// k�ik korras, email ei ole t�hi ja on olemas
			$signupEmail = $_POST["signupEmail"];
		}
		
	}
	
	$signupPasswordError = "";
	
	//kas on �ldse olemas
	if (isset ($_POST["signupPassword"])) {
		
		// oli olemas, ehk keegi vajutas nuppu
		// kas oli t�hi
		if (empty ($_POST["signupPassword"])) {
			
			//oli t�esti t�hi
			$signupPasswordError = "See v�li on kohustuslik";
			
		} else {
			
			// oli midagi, ei olnud t�hi
			
			// kas pikkus v�hemalt 8
			if (strlen ($_POST["signupPassword"]) < 8 ) {
				
				$signupPasswordError = "Parool peab olema v�hemalt 8 tm pikk";
				
			}
			
		}
		
	}
	
	
	$gender = "";
	if(isset($_POST["gender"])) {
		if(!empty($_POST["gender"])){
			
			//on olemas ja ei ole t�hi
			$gender = $_POST["gender"];
		}
	}
	
	if (isset($_POST["signupEmail"]) &&
		isset($_POST["signupPassword"]) &&
		$signupEmailError == "" &&
		empty($signupPasswordError)
	   ) {
			
		//�htegi viga ei ole, k�ik vajalik on olemas
		echo "salvestan...";
		echo "email ".$signupEmail."<br>";
		echo "parool ".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		
		echo "hash ".$password."<br>";
		
		
		//�hendus
		$database = "if16_kenkool";
		$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
		
		//Kk�sk
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		
		echo $mysql->error;
		
		// s - string
		// i - int
		// d - decimal/double
		// iga k�sim�rgi jaoks �ks t�ht, mis t��pi on
		$stmt->bind_param("ss", $signupEmail, $password );
		
		if ( $stmt->execute() ) {
			
			echo " salvestamine �nnestus";
			
	   } else {
		   
		   echo"ERROR ".$stmt->error;
	   
			
		}
		
		
	}
	
	
	$signupCountryError = "";
	$signupCountry = "";
	
	//kas on �ldse olemas
	if (isset ($_POST["signupCountry"])) {
		
		// oli olemas, ehk keegi vajutas nuppu
		// kas oli t�hi
		if (empty ($_POST["signuCountry"])) {
			
			//oli t�esti t�hi
			$signupCountryError = "See v�li on kohustuslik";
			
		} else {
				
			// k�ik korras, lahter ei ole t�hi ja on olemas
			$signupCountry = $_POST["signupCountry"];
		}
		
	}
	
	
	
	
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sisselogimise leht</title>
	</head>
	<body>

		<h1>Logi sisse</h1>
		
		<form method="POST">
			
			<label>E-post</label><br>
			<input name="loginEmail" type="email">
			
			<br><br>
			
			<label>Parool</label><br>
			<input name="loginPassword" type="password">
						
			<br><br>
			
			<input type="submit">
		
		</form>
		
		<h1>Loo kasutaja</h1>
		
		<form method="POST">
			
			<label>E-post</label><br>
			<input name="signupEmail" type="email" value="<?php echo $signupEmail; ?>" > <?php echo $signupEmailError; ?>
			
			<br><br>
			
			<input placeholder="Parool" name="signupPassword" type="password"> <?php echo $signupPasswordError; ?>
						
			<br><br>
			
			<?php if ($gender == "male") { ?>
				<input type="radio" name="gender" value="male" checked > Mees<br>
			<?php } else { ?>
				<input type="radio" name="gender" value="male"> Mees<br>
			<?php } ?>
			
			<?php if ($gender == "female") { ?>
				<input type="radio" name="gender" value="female" checked > Naine<br>
			<?php } else { ?>
				<input type="radio" name="gender" value="female"> Naine<br>
			<?php } ?>
			
			<?php if ($gender == "other") { ?>
				<input type="radio" name="gender" value="other" checked > Muu<br>
			<?php } else { ?>
				<input type="radio" name="gender" value="other"> Muu<br>
			<?php } ?>
			
			
		
		</form>

		
		</head>
	<body>

	
		
		<form method="POST">
			
			<label>Mobiiltelefoni number</label><br>
			<input name="number" type="text">
			
			<br><br>
			
			<label>Riik</label><br>
			<input name="Country" type="text">
						
			<br><br>
			
			<input type="submit" value="Loo kasutaja">
			
		</form>
		
		
		
	</body>
</html>

