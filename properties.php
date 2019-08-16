<!DOCTYPE html>
<html>
<?php
	include_once("SessionVariables.php");
	include_once("DatabaseFunctions.php");
?>
<head>
<title>Travel Buddy - Properties</title>
<link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>

	<form method="post">
		<div class="headbox">
			<img src="img_website/logoheader.jpg" class="logo">
			<?php					
			if (getSessionStatus()){ //If session exists display users name, otherwise suggest to login or sign-up
				echo '<a href="login.php" class="login">'. getUserName(getUser()) .'</a>';
			}
			else {
				echo '<a href="login.php" class="login">Login/Sign-Up</a>';
			}
			?>
			<a href="properties.php" class="properties">Guest Houses</a>
			<a href="sign-up.php" class="register">Register</a>
		</div>
		<div class="headbox2">
			<img src="img_website/logo.jpg" class="logo" alt="logo">
		</div>
		<select name="cityFilter" class="styled-select black rounded">
			<option value="allCities">All Cities</option>
			<?php
			getCities();
			?>
		</select>
		<select name="suburbFilter" class="styled-select black rounded">
			<option value="allSuburbs">All Suburbs</option>
			<?php
			getSuburbs();
			?>
		</select>
		<select name="poolFilter" class="styled-select black rounded">
			<option value="all">Has Pool/No Pool</option>
			<option value="Yes">Has Pool</option>
			<option value="No">No Pool</option>
		</select>
		<select name="priceFilter" class="styled-select black rounded">
			<option value="orderBy">Order By</option>
			<option value="lowestPrice">Lowest Price</option>
			<option value="highestPrice">Highest Price</option>
		</select>
		<div style="width: auto; height: auto; padding: none; margin: none; float: right;">
			<input type="text" placeholder="Search..." name="search_text" class="element" >
			<input type="submit" name="search" class="btn_search" value="Search" >
		</div>
		<input type="submit" name="sort" class="btn_search" value="Sort"></br></br>
		Min Price: <input type="text" name="minPrice" class="textinput">
		Max Price: <input type="text" name="maxPrice" class="textinput">
		Min Bedrooms: <input type="text" name="minBedrooms" class="textinput">
		Date: <input type="date" name="date" class="textinput">
			</br></br>
			
			<?php
			$searchString = "";
			if (isset($_POST['search'])) {
				$searchString = $_POST['search_text'];
			}
			$cityFilter = "";
			$suburbFilter = "";
			$statusFilter = "";
			$poolFilter = "";
			$priceFilter = "";
			$minPrice = "";
			$maxPrice = "";
			$minBedrooms = "";
			$date = "";
			if (isset($_POST['cityFilter']) && $_POST['cityFilter'] != "allCities") {
				$cityFilter = $_POST['cityFilter'];
			}
			if (isset($_POST['suburbFilter']) && $_POST['suburbFilter'] != "allSuburbs") {
				$suburbFilter = $_POST['suburbFilter'];
			}
			if (isset($_POST['poolFilter']) && $_POST['poolFilter'] != "all") {
				$poolFilter = $_POST['poolFilter'];
			}
			if (isset($_POST['priceFilter']) && $_POST['priceFilter'] != "orderBy") {
				$priceFilter = $_POST['priceFilter'];
			}
			if (isset($_POST['minPrice']) && $_POST['minPrice'] != "") {
				$minPrice = $_POST['minPrice'];
			}
			if (isset($_POST['maxPrice']) && $_POST['maxPrice'] != "") {
				$maxPrice = $_POST['maxPrice'];
			}
			if (isset($_POST['minBedrooms']) && $_POST['minBedrooms'] != "") {
				$minBedrooms = $_POST['minBedrooms'];
			}
			if (isset($_POST['date']) && $_POST['date'] != "") {
				$date = $_POST['date'];
			}
			getProperties($searchString, $cityFilter, $suburbFilter, $poolFilter, $priceFilter, $minPrice, $maxPrice, $minBedrooms, $date);
			?>

	</form>

</body>
</html>