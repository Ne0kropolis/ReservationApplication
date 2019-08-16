<!DOCTYPE html>
<html>
	<head>
	<title>Travel Buddy - Rate</title>
		<?php
			include_once("SessionVariables.php");
			include_once("DatabaseFunctions.php");
		?>
		<link rel="stylesheet" type="text/css" href="css/home.css">
	</head>
	<body>

		<form method="post" action="" class="form" id="ratingform">
			<div class="headbox">
				<img src="img_website/logoheader.jpg" class="logo">
					<?php				
						if (getSessionStatus()){ //If session exists display users name, otherwise suggest to login or sign-up
							echo '<a href="properties.php" class="login">'. getUserName(getUser()) .'</a>';
							//echo "<script type='text/javascript'>alert('" . $_GET['id'] . "')</script>";
						}
						else {
							echo '<a href="login.php" class="login">Login</a>';
						}
					?>	
			</div>
			<div class="headbox2">
				<img src="img_website/logo.png" class="logo">
			</div>
			<div class='title_block center'>
			<h1><b>Rating Form</b></h1>
			</div>
			<div class='product_block'>
				<b>Please Rate Your Stay:</b> <br> <input type="number" name="rating" min="1" max="10" required >
			</div>
			<div class='product_block'>
				<b>Additional Comments:</b> <textarea form="ratingform" name="comments" required></textarea>
			</div>
			<div class='product_block'>
				<button type = 'submit' id = 'addToCart' name = 'rate' value = "purchase">Confirm</button>
				<button type="button" name="back" onclick="document.location.href='properties.php'" style="padding: 15px; float: right">Back</button>
			</div>
				
			<?php
				if (isset($_POST['rate'])) {
					$propertyID = $_GET['property'];
					$userID = $_GET['user'];
					insertRating($propertyID, $userID, $_POST['rating'], $_POST['comments']);
				}
			?>
		</form>
	</body>
</html>
